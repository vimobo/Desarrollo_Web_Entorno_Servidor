<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FuncionesParaTexto</title>
</head>
<body>
    <?php
        $cadena = "Hola mundo. ¿Qué tal estáis hoy?";

        function contarLetras($s) {
            return strlen($s);
        }

        function docePrimeros($s) {
            return substr($s, 0, 11);
        }

        function buscarPalabra($string, $s) {
            return strpos($string,$s);
        }

    ?>

    <div>
        <p>
            <?=contarLetras($cadena)?>
        </p>
        <p>
            <?=docePrimeros($cadena)?>
        </p>
        <p>
            <?=buscarPalabra($cadena, "mundo")?>
        </p>
        <p>
            <?=buscarPalabra($cadena, "mundo")?>
        </p>
        <p>
            <?=strtoupper($cadena)?>
        </p>
        <p>
            <?=strtolower($cadena)?>
        </p>
        
        <p>
            <?=strrev($cadena)?>
        </p>
       
        <p>
            <?=substr($cadena, strpos($cadena, "."))?>
        </p>
    </div>
</body>
</html>