<?php
include_once("./Carta.php");
include_once("./Baraja.php");
include_once("./Jugador.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Cartas</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

<div class="cardField">

    <?php

    if (!isset($_SESSION["baraja"])) {
        $baraja = new Baraja();
        $jugador = new Jugador(false);
        $banca = new Jugador(true);
        $baraja->crearBarajaCompleta();
        $baraja->barajarBaraja();


        $_SESSION["baraja"] = $baraja;
        $_SESSION["jugador"] = $jugador;
        $_SESSION["banca"] = $banca;
    }

    $baraja = $_SESSION["baraja"];
    $jugador = $_SESSION["jugador"];
    $banca = $_SESSION["banca"];

    if (isset($_POST["repartir"])) {
        $jugador->sacarPrimeraCarta($baraja);

        $_SESSION["baraja"] = $baraja;
        $_SESSION["jugador"] = $jugador;
    }

    if (isset($_POST["plantarse"])) {
        $jugador->plantarse($banca, $baraja);

        $_SESSION["baraja"] = $baraja;
        $_SESSION["jugador"] = $jugador;
        $_SESSION["banca"] = $banca;
    }

    if (isset($_POST["reiniciar"])) {
        $baraja = new Baraja();
        $baraja->crearBarajaCompleta();
        $baraja->barajarBaraja();

        $jugador = new Jugador(false);
        $banca = new Jugador(true);

        $_SESSION["baraja"] = $baraja;
        $_SESSION["jugador"] = $jugador;
        $_SESSION["banca"] = $banca;
    }
    ?>
</div>

    <div class="buttons">

        <form method="POST">
            <button type="submit" name="repartir">Repartir carta</button>
        </form>
        <form method="POST">
            <button type="submit" name="reiniciar">Reiniciar</button>
        </form>
        <form method="POST">
            <button type="submit" name="plantarse">Plantarse</button>
        </form>
    </div>

</body>

</html>