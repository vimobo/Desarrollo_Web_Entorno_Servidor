<?php

declare(strict_types=1);

namespace Requests;

use Models\User;
use finfo;

// ----------------------------------------------------------
// CLASSES
// ----------------------------------------------------------

        const TAM_MAX = 2 * 1024 * 1024; // 2 MB


class UserRequest
{
    // ----------------------------------------------------------
    // STATIC
    // ----------------------------------------------------------

    private static int $MINIMUM_USERNAME_CHARCTERS = 3;
    private static int $MINIMUM_PASSWORD_CHARACTERS = 12;

    // ----------------------------------------------------------
    // ATTRIBUTES
    // ----------------------------------------------------------

    public private(set) array $errors = [];

    // ----------------------------------------------------------
    // CONSTRUCTORS
    // ----------------------------------------------------------

    public function __construct(
        private User &$user
    ) {
        $this->cleanUp();
        $this->validate();
    }

    // ----------------------------------------------------------
    // METHODS
    // ----------------------------------------------------------

    /**
     * isValid
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    /**
     * cleanUpUsername
     *
     * @return void
     */
    private function cleanUpUsername(): void
    {
        $this->user->username = trim(strip_tags($this->user->username));
    }



    /**
     * cleanUpPassword
     *
     * @return void
     */
    private function cleanUpPassword(): void
    {
        $this->user->password = strip_tags($this->user->password);
    }



    private function validateImg()
    {

        $this->errors['img'] = null;
        $success = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])) {
            $img = $_FILES['img'];

            var_dump($img);

            if ($img['error'] !== UPLOAD_ERR_OK) {
                $this->errors['img'] = 'Error en la subida del archivo (código ' . $img['error'] . ').';

            } elseif ($img['size'] > TAM_MAX) {
                // 2. Tamaño máximo permitido
                $this->errors['img'] = 'El archivo supera los 2 MB permitidos.';

            } elseif (!is_uploaded_file($img['tmp_name'])) {
                // 3. ¿Proviene realmente de una subida HTTP POST?
                $this->errors['img'] = 'Petición no válida.';

            }
            // 4. Validación estricta del tipo real (no del que declara el navegador)
            if (!$this->errors['img']) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mimeReal = $finfo->file($img['tmp_name']);

                // Tipos MIME permitidos y la extensión segura que les corresponde
                $permitidos = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/gif' => 'gif'
                ];

                if (!array_key_exists($mimeReal, $permitidos)) {
                    $error = 'Formato no permitido. Solo se aceptan JPG, PNG y GIF.';
                }
            }
            if (!$this->errors['img']) {
                // 5. La extensión sale del MIME real, nunca del nombre que da el usuario.
                // El nombre es único e impredecible: fecha + valor aleatorio.
                $nombreFinal = date('Ymd_His') . '_' . bin2hex(random_bytes(4))
                    . '.' . $permitidos[$mimeReal];
                // Resultado esperado: 20261019_113158_a61b8ff8.png
                $directorio = __DIR__ . '/img/';
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0755, true);
                }
                // 6. Movemos el archivo temporal a su ubicación definitiva
                if (move_uploaded_file($img['tmp_name'], $directorio . $nombreFinal)) {
                    return true;
                } else {
                    $this->errors['img'] = 'Error interno al guardar el archivo en el servidor.';
                }
            }

            var_dump($this->errors['img']);
        }



    }

    /**
     * validateUsername
     *
     * @return bool
     */
    private function validateUsername(): bool
    {
        $username = $this->user->username;

        if (strlen($username) < self::$MINIMUM_USERNAME_CHARCTERS) {
            $this->errors['username'] = 'The username must be at least ' . self::$MINIMUM_USERNAME_CHARCTERS . '-character long';
            return false;
        }

        if (preg_match('/\W/', $username)) {
            $this->errors['username'] = 'The username must only contain characters';
            return false;
        }

        return true;
    }

    /**
     * validatePassword
     *
     * @return bool
     */
    private function validatePassword(): bool
    {
        $password = $this->user->password;

        if (strlen($password) < self::$MINIMUM_PASSWORD_CHARACTERS) {
            $this->errors['password'] = 'The password must be at least ' . self::$MINIMUM_PASSWORD_CHARACTERS . '-character long';
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $this->errors['password'] = 'The password must contain at least a capital-case character';
            return false;
        }

        if (!preg_match('/[a-z]/', $password)) {
            $this->errors['password'] = 'The password must contain at least a camel-case character';
            return false;
        }

        if (!preg_match('/\d/', $password)) {
            $this->errors['password'] = 'The password must contain at least a digit';
            return false;
        }

        if (!preg_match('/[\.#$-_]/', $password)) {
            $this->errors['password'] = 'The password must contain at least one of the following symbols: . # $ - _';
            return false;
        }

        return true;
    }

    /**
     * cleanUp
     *
     * @return void
     */
    private function cleanUp()
    {
        $this->cleanUpUsername();
        $this->cleanUpPassword();
    }

    /**
     * validate
     *
     * @return void
     */
    private function validate()
    {
        $this->validateUsername();
        $this->validatePassword();
        $this->validateImg();
    }
}