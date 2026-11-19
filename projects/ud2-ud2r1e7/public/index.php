<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
        include_once("./Circulo.php");
        include_once("./Rectangulo.php");

        $circulo = new Circulo("Juan", 2);
        $rectangulo = new Rectangulo("Miguel", 10 ,20);

        echo("El area del rectangulo es ". number_format($rectangulo->calcularArea(), 2));
        echo("<br>El area del circulo es " . number_format($circulo->calcularArea(), 2));
    ?>
</body>
</html>