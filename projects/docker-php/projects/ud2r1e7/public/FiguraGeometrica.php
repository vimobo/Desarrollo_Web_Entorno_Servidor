<?php
abstract class FiguraGeometrica {

    public function __construct(
        private string $nombre
    ) {
    }

    abstract function calcularArea(): float;

    function mostrarNombre(): string {
        return $this->nombre;
    }
} 
?>