<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajedrez</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    function crearTablero()
    {
        $stringCompleta = "<table>";
        $contadorPieza = 0;
        $arrayPiezasN = ["torre", "caballo", "alfil", "rey", "reina", "alfil", "caballo", "torre"];
        $arrayPiezasB = ["torre", "caballo", "alfil", "reina", "rey", "alfil", "caballo", "torre"];

        for ($i = 0; $i < 8; $i++) {
            $stringImagen = "";
            $stringCompleta .= "<tr>";
            $contadorPieza = 0;
            for ($j = 0; $j < 8; $j++) {

                if($i == 0) {
                    $stringImagen = "<img src='./img/" . $arrayPiezasB[$contadorPieza] ."n.png'>";
                }

                if($i == 1) {
                    $stringImagen = "<img src='./img/peonn.png'>";
                }
                
                if($i == 6) {
                    $stringImagen = "<img src='./img/peonb.png'>";
                }
                
                if($i == 7) {
                    $stringImagen = "<img src='./img/" . $arrayPiezasB[$contadorPieza] ."b.png'>";
                }

                if (($i % 2 == 0 && $j % 2 == 0) || ($i % 2 == 1 && $j % 2 == 1)) {
                    $stringCompleta .= "<td class='blanca'>" . $stringImagen . "</td>";
                } else {
                    $stringCompleta .= "<td class='gris'>" . $stringImagen . "</td>";
                }

                $contadorPieza++;
            }
            $stringCompleta .= "</tr>";
            $stringImagen = "";
        }
        return $stringCompleta;
    }

    function imprimirFiguras() {

    }
    ?>

    <?= crearTablero() ?>
    <img src="" alt="">
</body>

</html>