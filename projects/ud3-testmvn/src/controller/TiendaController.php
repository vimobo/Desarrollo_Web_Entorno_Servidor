<?php
namespace controller;

use lib\Pages;
use model\Tienda;
use model\Producto;

class TiendaController
{
    public function mostrarCesta(): void
    {
        // Obtener los datos del modelo
        $p1 = new Producto(0, "Pelota", "puedes jugar con ella", 20, 3);
        $p2 = new Producto(1, "Sombrero", "Para los dias soleados", 40, 2);
        $tienda = new Tienda();
        $tienda->addProducto($p1);
        $tienda->addProducto($p2);

        // Renderizar la vista
        $pages = new Pages();
        $pages->render
        ('cestaTienda', [
                'tienda' => $tienda->imprimirProductos(),
            ]);
    }
}
?>