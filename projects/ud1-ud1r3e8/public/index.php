<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <title>Animales</title>
</head>

<body>
    <?php
    $arrayLength = rand(20, 30);
    $randAnimalArray = array_fill(0, $arrayLength, "");
    $animalesABorrar = [];


    //funcion para generar un array con emojis de animales
    function generarAnimales($array)
    {
        //el foreach funciona por copia no por referencia
        /*
        foreach ($array as $i => $animal) {
            $array[$i] = "&#" . rand(128000, 128060);
        }
        return $array;**/

        //mejor usar map
    
        return array_map(
            fn() => "&#" . rand(128000, 128060),
            $array
        );
    }

    //genera un string para imprimir un array;
    function generarStringAnimales($array)
    {
        $cadena = "";
        foreach ($array as $animal) {
            $cadena .= $animal . ", ";
        }
        return $cadena;
    }

    //Genera un solo animal al azar que aparece en el array de animales
    function animalAlAzar($array)
    {
        $animalRandom = "";
        global $animalesABorrar;

        do {
            $animalRandom = "&#" . rand(128000, 128060);

        } while (in_array($animalRandom, $array) == null);

        $animalesABorrar[] = $animalRandom;

        return $animalRandom;
    }

    //Hace un diff de el array de animales a borrar y el array de animales completo
    function borrarAnimal($array, $elementosABorrar)
    {
        return array_diff($array, $elementosABorrar);
    }

    $randAnimalArray = generarAnimales($randAnimalArray);
    ?>

    <p>Hay <?= $arrayLength ?> animales</p>
    <p><?= generarStringAnimales(generarAnimales($randAnimalArray)) ?> </p>
    <p>Animal a eliminar </p>
    <p><?= animalAlAzar($randAnimalArray) ?> </p>
    <p>Animales eliminados... </p>
    <p>Hay <?= count(borrarAnimal($randAnimalArray, $animalesABorrar)) ?> animales</p>

    <p><?= generarStringAnimales(borrarAnimal($randAnimalArray, $animalesABorrar)) ?> </p>
</body>

</html>