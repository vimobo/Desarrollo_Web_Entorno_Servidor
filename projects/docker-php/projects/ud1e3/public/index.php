<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuegoDeDados</title>
</head>

<body>
    <?php
    //Creamos un juego tirar los dados
    
    $nDado1 = rand(1, 6);
    $nDado2 = rand(1, 6);
    $resultado = "";
    $ruta1 = "./images/dice-six-faces-".$nDado1.".png";
    $ruta2 = "./images/dice-six-faces-".$nDado2.".png";
    

    if ($nDado1 > $nDado2)
        $resultado = "El dado 1 es mayor -> D1: " . $nDado1 . "<br>Ha sido el resultado mayor ";
    else if ($nDado1 < $nDado2)
        $resultado = "El dado 2 es mayor -> D2: " . $nDado2 . "<br>Ha sido el resultado mayor ";
    else
        $resultado = "Son iguales -> D: " . $nDado2;
    ?>
<main>
    <img src="<?=$ruta1?>" alt="asbasjbjasb" style="width: 100px; height: 100px;">    
    <img src="<?=$ruta2?>" alt="asbasjbjasb" style="width: 100px; height: 100px;">    
    <p><?= $resultado ?></p>
</main>
</body>

</html>