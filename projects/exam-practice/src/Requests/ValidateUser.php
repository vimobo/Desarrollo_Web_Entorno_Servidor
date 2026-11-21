<?php

declare(strict_types=1);

namespace Requests;

class ValidateUser {
    public static function validateUser( &$response) {
        if (strlen($response['email']) == 0)
            $response['errors']['email'] = "Email empty";

        if (!filter_var($response['email'], FILTER_VALIDATE_EMAIL))
            $response['errors']['email'] = "Email not válid";


        if (strlen($response['password']) < 8)
            $response['errors']['password'] = "Password is too short";

         if (!preg_match('/[A-Z]/', $response['password'])) {
            $response['errors']['password'] = "Requiere una mayúscula";
        }

        if (!preg_match('/[a-z]/', $response['password'])) {
            $response['errors']['password'] = "Requiere una minúscula";
        }

        if (!preg_match('/[0-9]/', $response['password'])) {
            $response['errors']['password'] = "Requiere un número";
        }

        if (strlen($response['password']) < 10) {
            $response['errors']['password'] = "Necesita al menos 10 caracteres";
        }
    }
}