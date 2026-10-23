<?php
declare(strict_types=1);
namespace model;


class Alumno {


    private int $anioNacimiento = 0;
    private string $nombre = "";

    public function __construct($anioNacimiento, $nombre) {
        $this->anioNacimiento = (int)$anioNacimiento;
        $this->nombre = $nombre;
    }

    /**
     * Get the value of anioNacimiento
     */
    public function getAnioNacimiento(): int
    {
        return $this->anioNacimiento;
    }

    /**
     * Set the value of anioNacimiento
     */
    public function setAnioNacimiento(int $anioNacimiento): self
    {
        $this->anioNacimiento = $anioNacimiento;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function calcularEdad () {
        $actualYear = date("Y");
        return ((int)$actualYear) -  $this->anioNacimiento; 
    }

    public function imprimirDatos() {
        return "<br>Nombre: " . $this->nombre . "<br>Edad: " . $this->calcularEdad();
    }
}
?>