<?php
namespace model;

class Alumnos {
    private array $alumnosList;

    public function __construct() {
        $this->alumnosList = [];
    }

    public function addAlumno(Alumno $alumno) {

        array_push($this->alumnosList, $alumno);
    }

    public function imprimirAlumnosList():string {
        $string = "";
        foreach($this->alumnosList as $alumno) {
            $string .= $alumno->imprimirDatos();
        }
        return $string;
    }
}

?>