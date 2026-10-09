<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reparto de mercancias</title>
</head>

<body>
    <?php

    use Vtiful\Kernel\Format;

    //Variables globales
    $pedidos;
    $pesoTotal;
    $precioTotal;
    $pedidosAceptados;
    $clientesBool;

    //creamos el array de array asociativo de procutos
    $productos = [
        [
            "producto" => "Cuaderno A4",
            "precio" => 2.5,
            "pesoEnKg" => 2,
            "stock" => 8,
            "descuento" => 10
        ],
        [
            "producto" => "Boligrafo",
            "precio" => 0.9,
            "pesoEnKg" => 0.4,
            "stock" => 25,
            "descuento" => null
        ],
        [
            "producto" => "Archivador",
            "precio" => 4.20,
            "pesoEnKg" => 3,
            "stock" => 1,
            "descuento" => 15
        ]
    ];

    $clientes = [
        [
            "id" => 0,
            "nombre" => "Juan"
        ],
        [
            "id" => 1,
            "nombre" => "Miguel"
        ],
        [
            "id" => 2,
            "nombre" => "Maria"
        ],
        [
            "id" => 3,
            "nombre" => "Olga"
        ],
    ];

    //funcion que calcula el preico y comprueba que el descuento no sea null
    function calcularPrecio($producto, $cantidad)
    {
        global $precioTotal;
        $descuento = $producto["descuento"] === null ? ($producto["descuento"] + 100) / 100 : 1;
        $precioActual = ($producto["precio"] * $descuento * 1.21) * $cantidad;
        $precioTotal += $precioActual;

        return $precioActual;
    }

    //funcion principal que monta el pedido de forma aleatoria y comprueba si hay stock y si el camion esta lleno
    function calcularPedido()
    {
        global $pedidos;
        global $productos;
        global $clientes;
        global $pesoTotal;
        global $pedidosAceptados;
        $camionVacio = true;

        for ($i = 0; $i < 15 && $camionVacio; $i++) {

            $productosCantidad = rand(1, 5);
            $nProducto = rand(0, 2);

            $productoActual = $productos[$nProducto];
            $clienteActual = $clientes[rand(0, 3)];

            $hayStock = true;

            if ($productoActual["stock"] - $productosCantidad <= 0)
                $hayStock = false;


            //generamos el id segun i y uso del operador terciaro segun comprobaciones
            $pedidos[] = [
                "id" => $i,
                "cliente" => $clienteActual["nombre"],
                "producto" => $productosCantidad . " x " . $productoActual["producto"],
                "aceptado" => $hayStock ? "ACEPTADO" : "RECHAZADO",
                "precio" => $hayStock ? calcularPrecio($productoActual, $productosCantidad) : "No hay stock",
                "carga" => "carga " . $productoActual["pesoEnKg"]
            ];

            $pesoTotal += $productoActual["pesoEnKg"];

            if ($hayStock) {
                $pedidosAceptados++;
            }
            if ($pesoTotal >= 15) {
                $camionVacio = false;
            }

        }
    }


    function imprimirPedidos($pedidos)
    {

        $stringADevolver = "";
        global $pesoTotal;
        global $precioTotal;
        global $pedidosAceptados;
        $pediosTotales = count($pedidos);

        for ($i = count($pedidos) - 1; $i >= 0; $i--) {
            $pedido = array_pop($pedidos);
            $stringADevolver .=
                $pedido["id"] . "\t" . "|" . "\t" .
                $pedido["cliente"] . "\t" . "|" . "\t" .
                $pedido["producto"] . "\t" . "|" . "\t" .
                $pedido["aceptado"] . "\t" . "|" . "\t" .
                $pedido["precio"] . "\t" . "|" . "\t" .
                $pedido["carga"] . "<br>";
        }
        if ($pesoTotal >= 15)
            $stringADevolver .= "<br>El camión está lleno. Peso total: " . $pesoTotal . " kg";
        else
            $stringADevolver .= "<br> El camión va perfecto: Peso total: " . $pesoTotal . " kg";

        $stringADevolver .= "<br> Precio total: " . $precioTotal . " €";

        $stringADevolver .= "<br> Pedidos Procesados: " . $pediosTotales;
        $stringADevolver .= "<br> Pedidos sin procesar: " . 15 - $pediosTotales;
        $stringADevolver .= "<br> Pedidos Aceptados: " . $pedidosAceptados;
        $stringADevolver .= "<br> Pedidos rechazados: " . $pediosTotales - $pedidosAceptados;
        return $stringADevolver;
    }


    calcularPedido();
    echo (imprimirPedidos($pedidos));
    ?>
</body>

</html>