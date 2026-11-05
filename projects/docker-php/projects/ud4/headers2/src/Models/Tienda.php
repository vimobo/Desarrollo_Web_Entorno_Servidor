<?php
declare(strict_types=1);

namespace Models;

use Controller\ErrorController;
use Models\Producto;

class Tienda
{

    private array $productos;


    public function __construct()
    {

        $this->productos = [];

        $p1 = new Producto(0, "Tenedor", "Par no mancharse las manos", 1.20);
        $p2 = new Producto(1, "Cuchara", "Puedes comer sopita...", 0.99);
        $p3 = new Producto(2, "Plato", "Para no manchar la mesa", 3.70);
        $p4 = new Producto(3, "Vaso", "Si tienes sed puedes comprarlo", 2.1);

        $this->addProducto($p1);
        $this->addProducto($p2);
        $this->addProducto($p3);
        $this->addProducto($p4);
    }

    public function getProductos(): array
    {
        return $this->productos;
    }

    public function setProductos(array $value)
    {
        $this->productos = $value;
    }

    public function addProducto(Producto $p): void
    {
        $this->productos[$p->getId()] = [
            "id" => $p->getId(),
            "nombre" => $p->getNombre(),
            "precio" => $p->getPrecio(),
            "descripcion" => $p->getDescripcion(),
        ];
    }

    public function getProductoById(int $id): array
    {

        $producto = isset($this->productos[$id]) ? $this->productos[$id]: null;


        if (isset($producto)) {

            http_response_code(200);
            return $producto;

        } else {

            ErrorController::show_error404();
            return [];
        }
    }

}