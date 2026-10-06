<?php
class Producto {
    private string $nombre;
    private int $precio;

    function __construct(string $nombre, int $precio ) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    function getNombre(): string {    
        return $this->nombre;
    }

    function getPrecio(): int {
        return $this->precio;
    }

    function setNombre(string $nombre): string {
        $this->nombre = $nombre;
    }

    function setPrecio(int $precio): int {
        $this->precio = $precio;
    }
}
?>