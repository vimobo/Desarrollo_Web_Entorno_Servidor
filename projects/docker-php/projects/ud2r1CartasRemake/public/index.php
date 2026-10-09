<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Cartas</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>


    <?php
    include("./functions.php");

    crearBarajaCompleta();
    echo(imprimirBaraja());

    //crearBarajaReducida();
    barajarBaraja($barajaActual);
    //echo(imprimirBaraja());
    //echo(imprimirBarajaConImagenes());
    //echo("____________________________<br>");
    //echo(imprimirCarta($barajaActual));
    //sacarCarta($barajaActual);
    //echo(imprimirBaraja());
    //print_r($barajaActual);
    ?>

</body>
</html>