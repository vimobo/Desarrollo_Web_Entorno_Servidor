<?php
declare(strict_types=1);

namespace controller;

class Tienda
{

    private array $productosList;

    public function __construct()
    {
        $this->productosList = [];
    }


    public function getProductosList(): array
    {
        return $this->productosList;
    }

    public function setProductosList(array $value): void
    {
        $this->productosList = $value;
    }

    public function addProducto(Producto $producto): void
    {
        $this->productosList[] = $producto;
    }

    public function calculatePrice()
    {
        $total = 0;
        foreach ($this->productosList as $producto) {
            $total += $producto->calculatePriceProducto();
        }
        return $total;
    }


}

$p1 = new Producto(0,"Pelota", "puedes jugar con ella", 20, 3);
echo($p1);
?>