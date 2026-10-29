<?php
declare(strict_types=1);

namespace Requests;

use function Lib\e;
use Pages;

class ContactRequest
{

    public function __construct(
        public private(set) string $username = '',
        public private(set) string $password = '',
    ) {
    }


    static function sanearString($string)
    {
        return filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public static function sanear(array $data): self
    {
        return new self(
            username: self::sanearString(e($data['username'])),
            password: self::sanearString(e($data['password'])),
        );
    }



    public static function sanearYValidar(array $data): array
    {
        $request = self::sanear($data);

        return  [
            'request' => $request,
            'errores' => $request->validar()
        ];

    }

    public function validar(): array
    {
        $errores = [];

        if ($this->username === '') {
            $errores['username'] = 'El nombre de usuario es obligatorio.';
        }

        if (strlen($this->username) < 3) {
            $errores['username'] = 'El usuario debe tener al menos 3 caracteres.';
        }

        if ($this->password === '') {
            $errores['password'] = 'La contraseña es obligatoria.';
        }

        if (strlen($this->password) < 8) {
            $errores['password'] = 'La contraseña debe tener al menos 8 caracteres.';
        }

        return $errores;
    }
}

?>

