<?php
    declare(strict_types=1);

    namespace Models;

    class User {

        private string $username;
        private string $password;

        
    

	public function __construct() {

		$this->username = "vicenvicen";
		$this->password = "1234";
	}

	public function getUsername() : string {
		return $this->username;
	}

	public function setUsername(string $value) {
		$this->username = $value;
	}

	public function getPassword() : string {
		return $this->password;
	}

	public function setPassword(string $value) {
		$this->password = $value;
	}
}