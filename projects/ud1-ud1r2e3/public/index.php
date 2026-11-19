<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
</head>
<body>
    <?php
        $n1 = isset($_GET["n1"]) ? (float) $_GET["n1"] : null;
        $exponente =  isset($_GET["exponente"]) ? (float)  $_GET["exponente"] : 2;
        $total = 0;
        if (is_float($n1) && is_float($exponente)) {

            $total = pow($n1, $exponente);
            }
        else {
            $total = "No es un float";
            }
    ?>

    <p><?=$total?></p>
</body>
</html>