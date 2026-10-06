<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array de Arrays</title>
</head>

<body>
    <?php

    //a) Crear un array con al menos los datos de 3 profesores
    $profesores = [
        [
            "registro" => "P001",
            "nombre" => "Juan",
            "apellidos" => "García López",
            "telefono" => "600123456",
            "fechaNacimiento" => "1990-05-12"
        ],
        [
            "registro" => "P002",
            "nombre" => "Ana",
            "apellidos" => "Martínez Pérez",
            "telefono" => 611234567,
            "fechaNacimiento" => "1985-10-23"
        ],
        [
            "registro" => "P003",
            "nombre" => "Pedro",
            "apellidos" => "Sánchez Gómez",
            "telefono" => 622345678,
            "fechaNacimiento" => "1978-03-08"
        ]
    ];

    //b) Crear una función que nos permita mostrar el número de registro personal de cada uno de los profesores
    function imprimirCodigos()
    {
        global $profesores;

        $cadena = "";

        foreach ($profesores as $profesor) {
            $cadena .= "<br>" . $profesor["registro"];
        }
        ;
        return $cadena;
    }

    //c) Modifica la función anterior y conviértela en una función anónima (usa array_map()).
    function imprimirCodigosMap()
    {
        global $profesores;

        return implode(' ', array_map(
            fn($profesor) => $profesor["registro"],
            $profesores
        ));
    }

    //d) Crea una función anónima que nos permita mostrar los profesores que han nacido a partir de 1990. ( Usa strtotime() y array_filter()
    ?>

    <p>
        <?= imprimirCodigos() ?>

    </p>

    <p>
        <?= imprimirCodigosMap() ?>
    </p>
</body>

</html>