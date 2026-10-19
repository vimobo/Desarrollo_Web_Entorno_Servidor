<?php
    interface CalcularEnvio {
        public function calcularCosto($peso, $distancia): float;
    }
?>