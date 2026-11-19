<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cuadrado40Numeros</title>
    </head>
    <body>

        
        <?php
        //bucle concatenado para imprimir un numero de <p>
        $stringFinal = "";
        $resultadoExponente = 0;

        for($i = 1; $i <= 40; $i++) {
            $resultadoExponente = $i * $i;
            $stringFinal .= "<p>". $i . " * ". $i . " = " . $resultadoExponente . "<br></p>";
        }
        ?>

        <div>
            <?=$stringFinal?>
        </div>
    </body>
</html>