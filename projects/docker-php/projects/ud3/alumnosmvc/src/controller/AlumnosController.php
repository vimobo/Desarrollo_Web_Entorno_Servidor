<?php

namespace controller;

use model\Alumno;
use model\Alumnos;
use lib\Pages;

class AlumnosController {
    private $pages;
    private Alumnos $alumnos;


    public function __construct() {
        $this->pages = new Pages();
        $this->alumnos = new Alumnos();
    }

    public function renderAlumnos(): void {
        $this->pages->render("alumnos", ['alumnosList' => $this->alumnos->imprimirAlumnosList()]);
    }

    public function crearAlumno(): void
{
    $nombre = $_GET['nombre'];
    $anio = $_GET['anio'];
    // Crear el alumno con los datos recibidos
    $this->alumnos->addAlumno(new Alumno($nombre, $anio));
}

}
?>