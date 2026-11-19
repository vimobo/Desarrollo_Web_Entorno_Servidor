<?php

 $palos = ["oros", "copas", "espadas", "bastos"];
    $barajaActual = [];

    //crea una baraja dependiendo de los palos y los numeros que le pedimos
    function crearBarajaCompleta()
    {
        global $barajaActual;
        global $palos;
        $numerosBarajaCompleta = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        for ($i = 0; $i < count($palos); $i++) {
            for ($j = 0; $j < count($numerosBarajaCompleta); $j++) {
                array_push($barajaActual, [$numerosBarajaCompleta[$j], $palos[$i]]);
            }
        }
    }

    function crearBarajaReducida()
    {
        global $barajaActual;
        global $palos;
        $numerosBarajaReducida = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12];
        for ($i = 0; $i < count($palos); $i++) {
            for ($j = 0; $j < count($numerosBarajaReducida); $j++) {
                array_push($barajaActual, [$numerosBarajaReducida[$j], $palos[$i]]);
            }
        }
    }

    //devuelve un string con todas las cartas
    function imprimirBaraja() {
        global $barajaActual;
        $stringADevolver = "";
        foreach($barajaActual as $carta){
            $stringADevolver .= $carta[0] . " de " . $carta[1];
        }
        return $stringADevolver;
    }

    function imprimirBarajaConImagenes() {
        global $barajaActual;
        $stringADevolver = "";

        for ($i = 0; $i < count($barajaActual); $i++){
            $stringADevolver .= "<div class='cartaDiv'><img src='./imagenes/". $barajaActual[$i][1] . "_" . $barajaActual[$i][0] . ".jpg' alt='carta'><p>"; 
            $stringADevolver .= $barajaActual[$i][0] . " de " . $barajaActual[$i][1] . "</p></div>";
        }
        return $stringADevolver;
    }


    function barajarBaraja(&$baraja) {
        shuffle($baraja);
    }

    function sacarCarta(&$baraja) {
        echo(imprimirCarta($baraja));
        unset($baraja[0]);
    }

    function imprimirCarta ($baraja) {
        return "<div class='cartaDiv'><img src='./imagenes/". $baraja[0][1] . "_" . $baraja[0][0] . ".jpg' alt='carta'> <br> <p>".  $baraja[0][0] . " de " . $baraja[0][1] . "</p></div>";
    }
?>