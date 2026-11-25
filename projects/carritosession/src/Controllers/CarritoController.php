<?php

declare(strict_types=1);

namespace Controllers;

use Core\Pages;

class CarritoController {

    private Pages $pages;

    public function productoForm() {
        $this->pages->render('carrito/carritoForm');
    }


	public function __construct() {

		$this->pages = new Pages();
	}

    public function aniadirProductos() {

        $nombre = $_POST['nombre'];
        $cantidad = (int) $_POST['cantidad'];
        
        if(empty($_SESSION["productos"]))
            //$_SESSION["productos"] = [];

        var_dump($cantidad, $nombre);
        
        if(!empty($_SESSION["productos"][$nombre]))
            $cantidad += $_SESSION["productos"][$nombre];

        $_SESSION["productos"][$nombre] =  $cantidad;
        var_dump($_SESSION["productos"]);
        
        $this->pages->render('carrito/carritoForm');
    }

    public function carrito()  {
        var_dump($_SESSION["productos"]);
        $this->pages->render("carrito/carrito", ["productos" => $_SESSION["productos"]] ?? []);
    }
    
    
}