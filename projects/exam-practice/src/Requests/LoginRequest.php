<?php

declare(strict_types=1);

namespace Requests;

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

    public static function authUser($user): bool
    {
        $data = UserRepository::getUser($user['email'] ?? "");
        
        if (!empty($data) || !password_verify($user['password'] ?? "", password_hash($data['password'], PASSWORD_DEFAULT))) {

            return true;
            }
        else {
            return false;
            var_dump($this->response);
            $this->response['errors']['auth'] = "User or password not found.";
        }
    }

}