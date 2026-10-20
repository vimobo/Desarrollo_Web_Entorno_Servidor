<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NumerosEntrDosValores</title>
</head>

<body>
    <?php

    //recoge dos variables desde la url y cuenta los numeros que hay entre medias
    
    $n1 = isset($_GET["numero1"]) ? (float) $_GET["numero1"] : null;
    $n2 = isset($_GET["numero2"]) ? (float) $_GET["numero2"] : null;
    $counter = 0;
    $numerosEntreMedias = [];

    if($n1 !== null && $n2 !== null && $n1 < $n2) {
        for($i = $n1 + 1; $i < $n2; $i++) {
            $numerosEntreMedias[$counter] = $i;
            $counter++;
        }
    }

    ?>

    <p>
        <?=implode(", ", $numerosEntreMedias)?>
    </p>
</body>

</html>