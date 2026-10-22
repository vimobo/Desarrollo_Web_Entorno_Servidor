<?php
    require __DIR__ . '/../autoloader.php';


    use model\Producto;
    use model\Tienda;
    use controller\TiendaController;
    use lib\Pages;

    echo '<h1>Proyecto: testMVC</h1>';

    $c1 = new TiendaController();
    $c1->mostrarCesta();




    ?>