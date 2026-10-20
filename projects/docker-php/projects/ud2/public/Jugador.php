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
                echo (($this->esBanca ? "<p>La banca" : "<p>El jugador ") . " saca una carta<br></p>");
            if(!$this->esBanca)
                echo($this->cartasSacadas->imprimirBarajaConImagenes());
            else 
                echo($carta->imprimirCartaImagen());

                echo ($this->esBanca ? "<p>La banca " . " tiene " . $this->puntos . " puntos<br>"  : "<p>El jugador " . " tiene " . $this->puntos . " puntos<br> </p>");


            if ($this->puntos > 7.5)
                echo ("<p>Te has pasado.</p>");
        } 
        else
            echo("<p>Ya no puedes tirar más. Has perdido. Reinicia la partida.</p>");


    }

    function plantarse($jugador, &$baraja)
    {
        echo ("<p>Te plantas con " . $this->puntos . " puntos. Ahora juega la banca<br></p>");

        do {
            $carta = $jugador->sacarPrimeraCarta($baraja);

        } while ($jugador->puntos <= $this->puntos && $jugador->puntos <= 7.5);


        if ($jugador->puntos > 7.5 || $this->puntos > $jugador->puntos)
            echo ("<p>Gana el jugador</p>");
        else
            echo ("<p>gana la banca</p>");
    }

    function reiniciar(): void
    {
        $this->puntos = 0;
        $this->cartasSacadas = new Baraja();
    }
}
?>