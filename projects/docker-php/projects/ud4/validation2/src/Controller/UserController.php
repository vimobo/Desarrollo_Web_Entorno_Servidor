<?php
declare(strict_types=1);


namespace Controller;

use Controller\AuthController;
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

        AuthController::login($respuesta, $this->pages, $this->user);

        
    }



}

?>