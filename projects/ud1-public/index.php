<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //Podemos usar variables con ""

    $nombre = 'vizius';
    echo "como estamos $nombre";


    // el punto concatena, y la coma muestra a continuación
    
    echo "". $nombre ."". $nombre ."", $nombre;
    
    $nombre = 'vi';
    $apellidos = 'vimobo';
    $plataforma = 'vscode';
    $precio = '10.4';
    ?>


    <!--Se puede llenar las variables de php con la siguiente sintaxis-->
    
    <p>nombre: <?= $nombre?></p>
    <p>apellidos: <?= $apellidos?></p>
    <p>plataforma: <?= $plataforma?></p>
    
    <?php 


    //el print devuelve un int, 1 si es correcto y -1 si no
    
    $resultado = (print('hola mundo')) + 5;
    echo 'Resultado: '. $resultado .'';

    //VAriables de variables
    //con el uso de pre, y concatenando el nombre de una variable, puedo conseguir su contenido
    echo '<pre>';
    
    $saludo_es = 'Hola';
    $saludo_en = 'Hello';

    $idioma = 'en';

    $nombre_variable = "saludo_". $idioma;

    echo ${"saludo_" . $idioma};
    echo $$nombre_variable;
    echo '</pre>';


    //el uso de format para controlar 

    $num_float = 34.0;

    echo "La salida usando la funcion echo es: $num_float";
    echo "<br> salida usando printf():";
    printf("%.3f", $num_float)


    //

    ?>
</body>
</html>
   