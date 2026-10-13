<?php
    include_once("./FiguraGeometrica.php");

class Rectangulo extends FiguraGeometrica{

    function __construct(
        string $nombre,
        private float $alto,
        private float $ancho
    ) {
        parent::__construct($nombre);
    }

    public function calcularArea(): float {
        return $this->alto * $this->ancho;
    }
}
?>