<?php
declare(strict_types=1);

namespace Requests;
use finfo;
const TAM_MAX = 1024 * 1024 * 2;

class ArchiveRequest
{

    private array $errors = [];

    public function __construct()
    {
        $this->errors = [];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validateImg()
    {

        $this->errors['img'] = null;
        $success = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])) {
            $img = $_FILES['img'];


            if ($img['error'] !== UPLOAD_ERR_OK) {
                $this->errors['img'] = 'Error en la subida del archivo (código ' . $img['error'] . ').';
                return false;


            } elseif ($img['size'] > TAM_MAX) {
                // 2. Tamaño máximo permitido
                $this->errors['img'] = 'El archivo supera los 2 MB permitidos.';
                return false;


            } elseif (!is_uploaded_file($img['tmp_name'])) {

                // 3. ¿Proviene realmente de una subida HTTP POST?
                $this->errors['img'] = 'Petición no válida.';
                return false;


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
                    $this->errors['img'] = 'Formato no permitido. Solo se aceptan JPG, PNG y GIF.';
                    return false;
                }
            }
            if (!$this->errors['img']) {
                // 5. La extensión sale del MIME real, nunca del nombre que da el usuario.
                // El nombre es único e impredecible: fecha + valor aleatorio.
                $nombreFinal = date('Ymd_His') . '_' . bin2hex(random_bytes(4))
                    . '.' . $permitidos[$mimeReal];
                // Resultado esperado: 20261019_113158_a61b8ff8.png
                $directorio = __DIR__ . '/../../public/img/';
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
        }
    }
}
?>