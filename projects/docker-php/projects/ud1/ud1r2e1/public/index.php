<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadenas</title>
</head>
<body>
    <?php


            $cadenaAImprimir = function ($cadenaFinal) {

            if(empty($cadenaFinal))

                $cadenaFinal = "lorem";
                
            else if (is_string($cadenaFinal)) 

                $cadenaFinal = strtoupper($cadenaFinal);
                
            else if (!is_string($cadenaFinal)) 

                $cadenaFinal .= $cadenaFinal + " No es un string";

            return $cadenaFinal;
                
        };

    ?>
    <p>
        <?=$cadenaAImprimir(123124)?>
    </p>
</body>
</html>