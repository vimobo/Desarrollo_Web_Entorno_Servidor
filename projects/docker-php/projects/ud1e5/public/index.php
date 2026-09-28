<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CalculosEsfera</title>
</head>
<body>
    <?php

    $radio = 10;
    $longitud = $radio * 2;
    $superficie = 4 * pi() * ($radio * $radio);
    $volumen = 4/3 * pi() * ($radio * $radio * $radio);
    ?>

    <p>Dado el radio <?=$radio?></p>
    <p>La longitud es  <?=$longitud?></p>
    <p>La superfície es  <?=number_format($superficie, 2)?></p>
    <p>El volumen es  <?=number_format($volumen, 2)?></p>
    
</body>
</html>