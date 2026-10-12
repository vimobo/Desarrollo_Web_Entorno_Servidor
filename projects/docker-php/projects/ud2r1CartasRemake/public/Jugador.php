<?php
include_once("./Carta.php");
include_once("./Baraja.php");
class Jugador
{

    private float $puntos = 0;
    private Baraja $cartasSacadas;
    function __construct(

        private bool $esBanca
    ) {
        $this->cartasSacadas = new Baraja();
    }



    function sacarPrimeraCarta(&$baraja)
    {
        if($this->puntos <= 7.5) {
            $carta = $baraja->quitarPrimerCarta();
            $this->cartasSacadas->aniadirCartas($carta);
            $this->puntos += $carta->calcularPuntos();
                echo (($this->esBanca ? "La banca" : "El jugador ") . " saca una carta<br>");
            if(!$this->esBanca)
                echo($this->cartasSacadas->imprimirBarajaConImagenes());
            else 
                echo($carta->imprimirCartaImagen());

                echo ($this->esBanca ? "La banca " .  " tiene " . $this->puntos . " puntos<br>"  : "El jugador " . " tiene " . $this->puntos . " puntos<br>");

            if ($this->puntos > 7.5)
                echo ("Te has pasado.");
        } 
        else
            echo("Ya no puedes tirar más. Has perdido. Reinicia la partida.");

    }

    function plantarse($jugador, &$baraja)
    {
        echo ("Te plantas con " . $this->puntos . " puntos. Ahora juega la banca<br>");

        do {
            $carta = $jugador->sacarPrimeraCarta($baraja);

        } while ($jugador->puntos <= $this->puntos && $jugador->puntos <= 7.5);


        if ($jugador->puntos > 7.5 || $this->puntos > $jugador->puntos)
            echo ("Gana el jugador");
        else
            echo ("gana la banca");
    }

    function reiniciar(): void
    {
        $this->puntos = 0;
        $this->cartasSacadas = new Baraja();
    }
}
?>