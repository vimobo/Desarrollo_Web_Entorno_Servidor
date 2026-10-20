<?php

require_once './CalcularEnvio.php';
require_once './EnvioBase.php';
class EnvioEstandard extends EnvioBase implements CalcularEnvio
{

    function __construct($peso, $distancia)
    {
        parent::__construct($peso, $distancia);
    }

    function calcularEnvio($peso, $distancia): float
    {
        $costo_base = 5.0;
        $costo_por_peso = $peso * 1.5;
        $costo_por_distancia = $distancia * 0.05;
        return $costo_base + $costo_por_peso + $costo_por_distancia;
    }
}

?>