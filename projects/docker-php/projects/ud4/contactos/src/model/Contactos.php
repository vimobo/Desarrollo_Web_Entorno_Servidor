<?php

declare(strict_types=1);
namespace model;

class Contactos {

    private string $nombre; 
    private string $contrasenia;
    private bool $check;
     
    


	public function __construct(string $nombre, string $contrasenia, bool $check) {

		$this->nombre = $nombre;
		$this->contrasenia = $contrasenia;
		$this->check = $check;
	}

	public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

	public function getContrasenia() : string {
		return $this->contrasenia;
	}

	public function setContrasenia(string $value) {
		$this->contrasenia = $value;
	}

	public function getCheck() : bool {
		return $this->check;
	}

	public function setCheck(bool $value) {
		$this->check = $value;
	}
}