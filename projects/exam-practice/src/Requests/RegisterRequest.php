<?php

declare(strict_types=1);

namespace Requests;

class RegisterRequest
{

    public private(set) array $response;





    public function __construct($response)
    {

        $this->response = $response;
        $this->sanitize();
        $this->validate();
    }

    public function sanitize(): void
    {
        SanitizeUser::sanitizeUser($this->response);
        $this->response['passwordR'] = htmlspecialchars(trim($this->response['passwordR']));
    }

    public function validate(): void
    {
        ValidateUser::validateUser($this->response);

        if ($this->response['password'] != $this->response['passwordR'])
            $this->response['errors']['password'] = "Passwords do not match";

    }

}