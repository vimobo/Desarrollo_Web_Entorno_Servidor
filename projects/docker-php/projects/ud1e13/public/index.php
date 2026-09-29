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

    <!--
    Suma +	?numero1=10&numero2=5&operando=%2B
    Resta -	?numero1=10&numero2=5&operando=-
    Multiplicación *	?numero1=10&numero2=5&operando=%2A
    División /	?numero1=10&numero2=5&operando=%2F !-->
    <?php

    /*
    $n1 = $_GET["numero1"] ?? null;
    $n2 = $_GET["numero2"] ?? null;
    $operando = $_GET["operando"] ?? null;
    $resultado = 0;*/

    $n1 = isset($_POST["numero1"]) ? (float) $_POST["numero1"] : null;
    $n2 = isset($_POST["numero2"]) ? (float) $_POST["numero2"] : null;
    $operando = $_POST["operando"] ?? null;
    $resultado = null;

    if ($operando == "+") {
        $resultado = $n1 + $n2;
    } else if ($operando == "-") {
        $resultado = $n1 - $n2;
    } else if ($operando == "*") {
        $resultado = $n1 * $n2;
    } else if ($operando == "/") {
        $resultado = $n1 / $n2;
    }


    ?>

    <div id="calculator-body">
        <h1>CALCULADORA</h1>
        <div id="calculator-variables">

            <p><?= $n1 ?></p>
            <p><?= $n2 ?></p>
            <p><?= $operando ?></p>
            <p><?= $resultado ?></p>
        </div>
    </div>
    <div id="user-input-container">
        <form method="POST">
            <div>

                <label>Número 1:</label>
                <input type="number" name="numero1">

                <label>Número 2:</label>
                <input type="number" name="numero2">

                <label>Operación:</label>
                <select name="operando">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>
            </div>

            <button type="submit">Calcular</button>

        </form>

    </div>
</body>

</html>