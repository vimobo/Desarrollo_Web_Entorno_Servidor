<?php

namespace Models;

use Valor;
use Palo;

class Carta
{
    public function __construct(
        private Valor $valor,
        private Palo $palo
    ) {}

    public function __toString(): string
    {
        return $this->valor->name . ' de ' . $this->palo->value;
    }

    public function getValor(): Valor
    {
        return $this->valor;
    }

    public function getPalo(): Palo
    {
        return $this->palo;
    }
}