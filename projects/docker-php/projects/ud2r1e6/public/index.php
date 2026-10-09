<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once("./CuentaBancaria.php");
    include_once("./CuentaAhorro.php");

    $cuenta1 = new CuentaAhorro("maria", 500, 3);
    echo($cuenta1->resumen());
    ?>
</body>
</html>