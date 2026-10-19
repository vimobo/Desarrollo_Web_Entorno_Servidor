<?php
include_once("./EnvioBase.php");
class EnvioExpres extends EnvioBase implements CalcularEnvio
{

    function __construct($peso, $distancia)
    {
        parent::__construct($peso, $distancia);
    }

    function calcularCosto($peso, $distancia): float
    {
        $costo_base = 5.0;
        $costo_por_peso = $peso * 1.5;
        $costo_por_distancia = $distancia * 0.05;
        $tarifa_estandar = $costo_base + $costo_por_peso + $costo_por_distancia;
        $cargo_urgencia = 10.0;
        $costo_final =  $tarifa_estandar + $cargo_urgencia;
        echo "El costo final para el envío Expres' ({$peso}kg, {$distancia}km) es: \${$costo_final}";

        return $costo_final;
    }
}
?>