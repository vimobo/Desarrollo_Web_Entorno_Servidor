<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    use Monolog\Formatter\ElasticsearchFormatter;

    $ruta = __DIR__ . "/../src/file.txt";
    $rutaBase = __DIR__ . "/../src/";
    $rutaSample = __DIR__ . "/../src/sample.txt";

    file_put_contents($rutaBase . "/wPermision.txt", "asdjasbdjabsdjabsdjasbdjasbdbasdhbhdbasdbassdbassdbasjbd");
    file_put_contents($rutaBase . "/woPermision.txt", "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb");
    file_put_contents($rutaBase . "/sample.txt", "Esto es predeterminado");

    chmod($rutaBase . "/woPermision.txt", 0200);

    function encontrarDirectorio(string $ruta)
    {

        $directorio = new DirectoryIterator($ruta);
        $rutaSample = __DIR__ . "/../src/sample.txt";

        if (is_dir($ruta) && !empty($ruta)) {
            foreach ($directorio as $archivo) {
                if (!$archivo->isDot() && !$archivo->isDir())
                    echo $archivo->getFilename() . "<br>";
            }

        } else {
            file_put_contents($ruta, "");
            copy($rutaSample, $ruta . "/sample.txt");
            echo ("se ha creado la ruta");
        }

    }
    encontrarDirectorio($rutaBase . "/hola");
    //$fichero = abrirFicheroSiLegible($rutaBase . "/wPermision.txt");
    //$fichero = abrirFicheroSiLegible($rutaBase . "/woPermision.txt");
    
    //var_dump($fichero);
    ?>

</body>

</html>