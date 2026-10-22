<?php
    require __DIR__ . '/../autoloader.php';


    use model\Producto;
    use model\Tienda;
    use lib\Pages;

    echo '<h1>Proyecto: testMVC</h1>';

    $p1 = new Producto(0, "Pelota", "puedes jugar con ella", 20, 3);
    $p2 = new Producto(1, "Sombrero", "Para los dias soleados", 40, 2);
    $tienda = new Tienda();
    $tienda->addProducto($p1);
    $tienda->addProducto($p2);



    $pages = new Pages();
    $pages->render
    ('cestaTienda', [
        'tienda' => $tienda->imprimirProductos(),
    ])
    ?>