<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siete y medio</title>
</head>

<body>
    <?php
    $barajaActual;
    $contadorCartasBorradas = 0;
    $puntosJugador = 0.0;
    $puntosCasa = 0.0;

    function generarBaraja()
    {
        global $barajaActual;
        $numerosBaraja = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12];
        $palosBaraja = ["copas", "bastos", "oros", "espadas"];

        for ($i = 0; $i < count($numerosBaraja); $i++) {
            for ($j = 0; $j < count($palosBaraja); $j++) {
                $barajaActual[] = ["numero" => $numerosBaraja[$i], "palo" => $palosBaraja[$j]];
            }
        }
    }

    function barajarCartas(&$baraja)
    {
        shuffle($baraja);
    }


    function imprimirBarja($baraja)
    {
        $stringADevolver = "";
        global $contadorCartasBorradas;

        for ($i = 0 + $contadorCartasBorradas; $i < count($baraja); $i++) {
            $carta = $baraja[$i];
            $stringADevolver .= $carta["numero"] . " de " . $carta["palo"] . "<br>";
        }
        return $stringADevolver;
    }


    function borrarCarta(&$baraja)
    {
        global $contadorCartasBorradas;
        unset($baraja[$contadorCartasBorradas]);
        $contadorCartasBorradas++;
    }

    function imprimirCarta(array $carta)
    {
        return $carta["numero"] . " de " . $carta["palo"] . "<br>";
    }

    function contarPuntos($carta)
    {

        global $puntosJugador;
        if ($puntosJugador <= 7) {

            if ($carta["numero"] >= 1 && $carta["numero"] <= 7) {

                $puntosJugador += $carta["numero"];
            } else {
                $puntosJugador += 0.5;
            }
        }
    }
    function contarPuntosCasa($carta)
    {

        global $puntosCasa;
        if ($puntosCasa <= 7) {

            if ($carta["numero"] >= 1 && $carta["numero"] <= 7) {

                $puntosCasa += $carta["numero"];
            } else {
                $puntosCasa += 0.5;
            }
        }
    }

    function jugar()
    {
        
        echo ("El jugador empieza a sacar cartas <br>");

        global $barajaActual;
        global $contadorCartasBorradas;
        global $puntosJugador;
        global $puntosCasa;
        do {
            echo (imprimirCarta($barajaActual[$contadorCartasBorradas]));

            contarPuntos($barajaActual[$contadorCartasBorradas]);
            borrarCarta($barajaActual);
            echo ("El jugador tiene " . $puntosJugador . " puntos <br>");

        } while ($puntosJugador < 7.5);

        if ($puntosJugador == 7.5) {
            echo ("ahora juega la casa <br>");

            do {
                echo (imprimirCarta($barajaActual[$contadorCartasBorradas]));
                contarPuntosCasa($barajaActual[$contadorCartasBorradas]);
                borrarCarta($barajaActual);
                echo ("La casa tiene " . $puntosCasa . " puntos <br>");
            } while ($puntosCasa < 7.5);

        }
        if ($puntosCasa > 7.5 && $puntosJugador <= 7.5)
            echo ("gana el jugador");
        else
            echo ("gana la casa");
    }

    generarBaraja();
    barajarCartas($barajaActual);
    jugar();
    ?>

</body>

</html>