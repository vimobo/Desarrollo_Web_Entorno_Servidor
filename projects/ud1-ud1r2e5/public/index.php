<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TipadoEstricto</title>
</head>

<body>
    <?php

    //PHP no hace conversiones automáticas
    declare(strict_types=1);

    
    function calcular(int|float $numero): ?string
    {
        if ($numero > 0) {
            return "El resultado es: " . ($numero * 2);
        }

        return null;
    }

    try {

        echo calcular(5);

        // Provocamos intencionadamente un TypeError
        echo calcular("hola");

    } catch (TypeError $e) {

        echo "Error de tipo: " . $e->getMessage();
    }
    ?>
</body>

</html>