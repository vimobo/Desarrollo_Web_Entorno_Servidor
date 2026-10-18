<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refactorizar</title>
</head>

<body>
    <?php
    include_once("./CalcularEnvio.php");
    include_once("./EnvioEstandard.php");
    include_once("./EnvioExpres.php");
    include_once("./EnvioInternacional.php");
    include_once("./EnvioBase.php");

    function obtenerCostoTotal(
        float $peso,
        float $distancia,
        string $tipoEnvio
    ): float {

        $envio = match ($tipoEnvio) {
            'estandar' => new EnvioEstandard($peso, $distancia),
            'expres' => new EnvioExpres($peso, $distancia),
            'internacional' => new EnvioInternacional($peso, $distancia),
            default => throw new InvalidArgumentException(
                'Tipo de envío desconocido.'
            )
        };

        return $envio->calcularEnvio($peso, $distancia);
    }



    ?>

    <p><?= obtenerCostoTotal(10, 20, "expres") ?></p>
</body>

</html>