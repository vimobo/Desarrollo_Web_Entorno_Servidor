<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <?php

    $n1 = $_GET["numero1"];
    $n2 = $_GET["numero2"];
    $operando = $_GET["operando"];
    $resultado = 0;

    if($operando == "+") {
        $resultado = $n1 + $n2;
    }
    else if($operando == "-"){
        $resultado = $n1 - $n2;
    }
    else if($operando == "*"){
        $resultado = $n1 * $n2;
    }
    else if($operando == "/"){
        $resultado = $n1 / $n2;
    }


        ?>

    <div id="calculator-body">
        <h1>CALCULADORA</h1>
        <div id="calculator-variables">

            <p><?=$n1?></p>
            <p><?=$n2?></p>
            <p><?=$operando?></p>
            <p><?$resultado?></p>
        </div>
    </div>
</body>

</html>