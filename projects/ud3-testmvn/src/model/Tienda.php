<?php
declare(strict_types=1);

namespace model;

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

    public function imprimirProductos(): string
    {
        $string = "";
        foreach ($this->productosList as $producto) {
            $string .= "<br>" . $producto->imprimirProducto() . "<br>Precio:" .
                $producto->calculatePriceProducto();
        }
        return $string;
    }


}


?>