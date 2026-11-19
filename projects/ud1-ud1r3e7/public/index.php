<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrado</title>
</head>
<body>
    <?php
    $paises = [
            'España' => 1000,
            'Francia' => 905,
            'Mallorca' => 10,
            'Guarica' => 100
        ];
    
        echo(print_r($paises));

        unset($paises["Francia"]);
        echo(print_r($paises));
    ?>
</body>
</html>