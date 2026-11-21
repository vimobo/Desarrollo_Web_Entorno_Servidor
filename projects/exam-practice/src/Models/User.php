<?php

declare(strict_types=1);

namespace Models;

class User {
    public private(set) string $username;
    public private(set) string $email;
    public private(set) string $password;




	public function __construct(string $email, string $password) {

		$this->username = substr($email, 0, strpos($email, "@"));
		$this->email = $email;
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}


}