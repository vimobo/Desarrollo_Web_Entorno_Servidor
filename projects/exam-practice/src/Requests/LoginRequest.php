<?php

declare(strict_types=1);

namespace Requests;

use Core\JsonInFile;
use Repository\UserRepository;

class LoginRequest
{

    public private(set) array $response;
    public private(set) array $data;





    public function __construct($response)
    {

        $this->response = $response;
        $this->sanitize();
        $this->validate();
    }

    public function sanitize(): void
    {
        SanitizeUser::sanitizeUser($this->response);
    }

    public function validate(): void
    {
        ValidateUser::validateUser($this->response);
    }

    public function authUser(): bool
    {
        $user = JsonInFile::getValueByKeyInJsonFile( __DIR__ . "/../database/users.json", $this->response['email']);

        if (is_null($user)) {
            $this->response['errors']['auth'] = "El usuario/contraseña no coinciden";
            return false;
        }
        if (!password_verify($this->response['password'], $user['password'])) {
            $this->response['errors']['auth'] = "El usuario/contraseña no coinciden";
            return false;
        }

        return password_verify($this->response['password'], $user['password']);
    }


}