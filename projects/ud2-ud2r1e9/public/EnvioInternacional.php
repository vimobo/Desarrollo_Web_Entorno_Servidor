<?php
include_once("./EnvioBase.php");
class EnvioInternacional extends EnvioBase implements CalcularEnvio
{

    function __construct($peso, $distancia)
    {
        parent::__construct($peso, $distancia);
    }

    function calcularCosto($peso, $distancia): float
    {
        $costo_base = 20.0;
        $costo_por_peso = $peso * 5.0;
        $costo_por_distancia = ($distancia > 500) ? $distancia * 0.1 : 0.0;
        $costo_final =  $costo_base + $costo_por_peso + $costo_por_distancia;
        echo "El costo final para el envío internacional' ({$peso}kg, {$distancia}km) es: \${$costo_final}";

        return $costo_final;
    }
}
?>