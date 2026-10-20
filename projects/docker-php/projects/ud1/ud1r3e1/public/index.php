<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones Básicas</title>
</head>

<body>
    <?php

    //Recorrer un array
    $array = [1, 2, 4, 5, 62, 53, 571, 24];
    echo (print_r($array));
    echo "<br>";

    //Ordenamos el array
    sort($array);
    echo (print_r($array));
    echo "<br>";
    
    //Count para la longitud
    echo(count($array));
    echo "<br>";

    //buscamos un elemento
    echo(array_search(62, $array));
    echo "<br>";
    
    ?>
</body>

</html>