<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relleno automatico</title>
</head>
<body>
    <?php

        //rellenamos array con números aleatorios
        $arrayAleatorio[] = "";

        for($i = 0; $i < 120; $i++) {
            $arrayAleatorio[$i] = rand(0,100);
        }

        echo(print_r($arrayAleatorio));
    ?>
</body>
</html>