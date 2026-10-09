<?php

class Carta {
    private string $numero;

    const array PALOS = ["espadas", "oros", "copas", "bastos"];
    const array VALORES = [1 => "as", 2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "cinco", 6 => "seis", 7 => "siete",
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
}
?>