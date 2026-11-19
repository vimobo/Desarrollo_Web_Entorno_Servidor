<?php
declare(strict_types=1);

namespace Models;

class Producto {


    private int $id;
    private string $nombre;
    private string $descripcion;
    private float $precio;


	public function __construct(int $id, string $nombre, string $descripcion, float $precio) {

		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->precio = $precio;
	}

	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value) {
		$this->id = $value;
	}

	public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

	public function getDescripcion() : string {
		return $this->descripcion;
	}

	public function setDescripcion(string $value) {
		$this->descripcion = $value;
	}

	public function getPrecio() : float {
		return $this->precio;
	}

	public function setPrecio(float $value) {
		$this->precio = $value;
	}


}