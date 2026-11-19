<?php
    
include_once("./Carta.php");

class Baraja
{

    private array $cartas;

    function __construct(
    ) {
        $this->cartas = [];
    }

    function aniadirCartas(Carta $carta ) {
        array_push($this->cartas, $carta);
    }

    function getCartas() {
        return $this->cartas;
    }

    function setCartas($cartas){
        $this->cartas = $cartas;
    }

    function crearBarajaCompleta()
    {
        $palos = ["oros", "copas", "espadas", "bastos"];
        $numerosBarajaCompleta = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12];
        for ($i = 0; $i < count($palos); $i++) {
            for ($j = 0; $j < count($numerosBarajaCompleta); $j++) {
                array_push($this->cartas, new Carta($palos[$i], $numerosBarajaCompleta[$j]));
            }
        }
    }


    function imprimirBaraja() {
        $stringADevolver = "";
        foreach($this->cartas as $carta){
            $stringADevolver .= $carta->imprimirCarta();
        }
        return $stringADevolver;
    }

    function imprimirBarajaConImagenes() {
        $stringADevolver = "";
        foreach ($this->cartas as $carta){
            $stringADevolver .= $carta->imprimirCartaImagen();
        }
        return $stringADevolver;
    }

    function barajarBaraja() {
        shuffle($this->cartas);
    }

    function quitarPrimerCarta(): Carta {
        return array_pop($this->cartas);
    }
}
?>