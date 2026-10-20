<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrado y Cubo</title>
</head>
<body>


    <?php

        //rellenamos array con números aleatorios
        $arrayN[] = "";
        $arrayCuadrado[] = "";
        $arrayCubo[] = "";

        $stringFinal = "    <table>
                                <tr>
                                  <td>N</td><td>Cuadrado</td><td>Cubo</td>
                              </tr>";

        for($i = 0; $i < 20; $i++) {
            $arrayN[$i] = rand(0,100);
            $arrayCuadrado[$i] = $arrayN[$i] * $arrayN[$i];
            $arrayCubo[$i] = $arrayCuadrado[$i] * $arrayN[$i];
            $stringFinal .= "    <tr>
                                    <td>". $arrayN[$i] ."</td>
                                    <td>". $arrayCuadrado[$i] ."</td>
                                    <td>". $arrayCubo[$i] ."</td>
                                </tr>";
        }

    ?>

    <p>
        <?=$stringFinal?>
    </p>
</body>
</html>