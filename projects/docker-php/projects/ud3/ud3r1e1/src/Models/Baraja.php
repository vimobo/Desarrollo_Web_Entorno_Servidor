<?php
declare(strict_types=1);

namespace Models;


use Valor;
use Palo;

class Baraja
{
    private array $cartas = [];

    public function __construct()
    {
        foreach (Palo::cases() as $palo) {
            foreach (Valor::cases() as $carta) {
                $this->cartas[] = new Carta($carta, $palo);
            }
        }
    }

    public function barajar(): void
    {
        shuffle($this->cartas);
    }

    public function mostrar(): void
    {
        foreach ($this->cartas as $carta) {
            echo $carta . '<br>';
        }
    }

    public function sacarCarta(): ? Carta
    {
        return array_pop($this->cartas);
    }
}
?>