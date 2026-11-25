<?php

declare(strict_types=1);

use Core\Router;
use Controllers\CarritoController;

Router::add("get", "/", [CarritoController::class, "productoForm"]);
Router::add("post", "/aniadirProductos", [CarritoController::class, "aniadirProductos"]);
Router::add("get", "/carrito", [CarritoController::class, "carrito"]);

