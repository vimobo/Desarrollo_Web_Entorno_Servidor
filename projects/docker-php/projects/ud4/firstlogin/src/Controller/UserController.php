<?php
declare(strict_types=1);


namespace Controller;

use Models\User;
use Lib\Pages;
use Requests\UserRequest;
use respuestas;

class UserController
{

    private Pages $pages;
    private User $user;


    public function __construct()
    {

        $this->pages = new Pages();
        $this->user = new User();
    }

    public function showform()
    {
        $this->pages->render('form/form');
    }


    public function process(): void
    {
        $valoresMandados = $_POST['data'] ?? [];

        $respuesta = UserRequest::validarYSanear($valoresMandados);

        // Si hay errores, volvemos al formulario
        if (isset($respuesta['errores'])) {
            $this->pages->render('form/form', $respuesta);
            return;
        }

        var_dump($this->user->getUsername());
        var_dump($respuesta['username']);
        var_dump($respuesta['password']);
        var_dump($this->user->getPassword());
        var_dump(password_verify(
                $respuesta['password'],
                $this->user->getPassword()
            ));
        // Comprobar usuario y contraseña
        if (
            $this->user->getUsername() === $respuesta['username'] &&
            password_verify(
                $respuesta['password'],
                $this->user->getPassword()
            )
        ) {
            $this->pages->render('form/formResponse', $respuesta['username']);
            return;
        }

        // Credenciales incorrectas
        $this->pages->render('form/form', [
            'errores' => [
                'login' => 'Usuario o contraseña incorrectos'
            ]
        ]);
    }



}

?>