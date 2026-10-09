<?php

//practicando con POO
    class CuentaAhorro extends CuentaBancaria {


        public function __construct(string $nombre, float $saldo, private int $interes) {
            parent::__construct($nombre, $saldo);
        }

        public function resumen()  {
            return "nombre: " . $this->nombre ." saldo: " . $this->getSaldo();
        }

    }
?>