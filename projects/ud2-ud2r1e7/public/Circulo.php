<?php
    include_once("./FiguraGeometrica.php");
    class Circulo extends FiguraGeometrica {

    function __construct(
        string $nombre,
        private float $radio) {
        parent::__construct($nombre);
        }

    function calcularArea():float {
        return pi() * ($this->radio * $this->radio);
    }

    }
?>