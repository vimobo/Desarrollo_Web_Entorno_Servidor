<?php
declare(strict_types=1);

namespace Controller;

use Lib\Pages;
use Models\User;

class AuthController
{


    public function __construct()
    {

    }
    public static function login(array $respuesta, Pages $pages, User $user): void
    {




        // Comprobar usuario y contraseña
        if (
            $user->getUsername() === $respuesta['username'] &&
            password_verify(
                $respuesta['password'],
                $user->getPassword()
            )
        ) {
            $pages->render('form/formResponse', ['username' => $respuesta['username']]);
            return;
            
            
            } else if (isset($respuesta['errores'])) {
                
                $pages->render('form/form', $respuesta);
            return;

        } else {

            // Credenciales incorrectas
            $pages->render('form/form', [
                'errores' => [
                    'login' => 'Usuario o contraseña incorrectos'
                ]
            ]);
        }


    }

}
?>