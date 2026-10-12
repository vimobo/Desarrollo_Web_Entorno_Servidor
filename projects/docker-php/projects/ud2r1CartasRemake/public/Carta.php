<?php
    
class Carta {
    private string $numero;
    

    const array PALOS = ["espadas", "oros", "copas", "bastos"];
    const array VALORES =   [1 => "as", 2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "cinco", 6 => "seis", 7 => "siete",
                            10 => "sota", 11 => "caballo", 12 => "rey"];

    function __construct(
    private string $palo,
    int $numero
    ) {
        if(!array_key_exists($numero, self::VALORES) || !in_array($palo, self::PALOS))
            throw new Exception("Numero out of bound");
        else if($numero == 10 ) {
            $this->numero = "Sota";
        }
        else if($numero == 11 ) {
            $this->numero = "Caballo";
        }
        else if($numero == 12 ) {
            $this->numero = "Rey";
        }
        else {
            $this->numero = (string) $numero;
        }
    }

    function getPalo(): string{
        return $this->palo;
    }
    function getNumero(): string{
        return $this->numero;
    }
    
    function setPalo(string $palo):void {
        $this->palo = $palo;
    }

    function setNumero(string $numero):void {
        $this->numero = $numero;
    }

    function imprimirCartaImagen(): string {
        return "<div class='cartaDiv'><img src='./imagenes/". $this->getPalo() . "_" . $this->getNumero() . ".jpg' alt='carta'><p>"
        . $this->getNumero() . " de " . $this->getPalo() . "</p></div>";
    }

    function imprimirCarta():string {
        return $this->getNumero() . " de " . $this->getPalo() . "</p></div>";
    }

    function calcularPuntos(): float {
        $n = (float) $this->numero;
        $valor = 0;
        if( $n > 0 && $n < 10)
            $valor = $n;
        else
            $valor = 0.5;
        return $valor;
    }
}
?>