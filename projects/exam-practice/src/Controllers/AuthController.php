<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Repository\UserRepository;
use Requests\RegisterRequest;
use Requests\LoginRequest;
use Requests\SanitizeUser;
use Models\User;

class AuthController
{

    private Pages $pages;



    public function __construct()
    {

        $this->pages = new Pages();
    }

    public function showHome(): void
    {
        $this->pages->render('auth/home');
    }

    public function login(): void
    {
        $this->pages->render('auth/login');
    }

    public function register(): void
    {
        $this->pages->render('auth/register');
    }

    public function processLogin(): void
    {
        $data = $_POST['data'];
        $request = new LoginRequest($data);
        if (!empty($request->response['errors'])) 
            $this->pages->render('auth/login', $request->response);
        else {
            $user = UserRepository::getUser($request->response['email']);

            
            if (LoginRequest::authUser($user))
                $this->pages->render('files/addFiles', $request->response);
            
            else {
                $this->pages->render('auth/login', $request->response);
            }

        }
    }

    public function processRegister(): void
    {
        $data = $_POST['data'];
        $request = new RegisterRequest($data);

        if (!empty($request->response['errors']))
            $this->pages->render('auth/register', $request->response);
        else {
            $user = new User($request->response['email'], $request->response['password']);
            UserRepository::addUserToJson($user);
        }

    }




}