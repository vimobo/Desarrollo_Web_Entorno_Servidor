<?php

declare(strict_types=1);

namespace Requests;

class UserRequest
{
    static public function validarYSanear(array $valores): array
    {
        $respuesta = [];

        // USERNAME
        if (isset($valores['username'])) {

            $username = trim($valores['username']);

            if (strlen($username) < 8) {
                $respuesta['errores']['username'] = "Necesita tener al menos 8 caracteres";
            }

            $respuesta['username'] = htmlspecialchars(
                $username,
                ENT_QUOTES,
                'UTF-8'
            );

        } else {
            $respuesta['errores']['username'] = "El usuario es obligatorio";
        }

        // PASSWORD
        if (isset($valores['password'])) {

            $password = $valores['password'];

            if (strlen($password) < 3) {
                $respuesta['errores']['password'] = "Necesita tener al menos 3 caracteres";
            }

            $respuesta['password'] = $password;

        } else {
            $respuesta['errores']['password'] = "La contraseña es obligatoria";
        }

        return $respuesta;
    }
}


