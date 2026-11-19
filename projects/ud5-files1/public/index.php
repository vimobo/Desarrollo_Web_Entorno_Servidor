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

    file_put_contents($rutaBase . "/wPermision.txt", "asdjasbdjabsdjabsdjasbdjasbdbasdhbhdbasdbassdbassdbasjbd");
    file_put_contents($rutaBase . "/woPermision.txt", "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb");

    chmod($rutaBase . "/woPermision.txt", 0200);
    function abrirFicheroSiLegible(string $rutaFichero)
    {
        $respuesta = [];

        if (is_file($rutaFichero)) {

            if (!is_readable($rutaFichero)) {
                $respuesta = ['status' => false, 'data' => 'no tienes permisos'];
            } else {
                $archivo = fopen($rutaFichero, "r");
                $contenido = fread($archivo, filesize($rutaFichero));
                $respuesta = ['status' => true, 'data' => $contenido];
                fclose($archivo);
            }

        } else {
            $respuesta = ['status' => false, 'data' => 'no existe el archivo'];
        }

        return $respuesta;
    }

    $fichero = abrirFicheroSiLegible($ruta);
    $fichero = abrirFicheroSiLegible($rutaBase . "/wPermision.txt");
    $fichero = abrirFicheroSiLegible($rutaBase . "/woPermision.txt");

    var_dump($fichero);
    ?>

    <div>
        <p>

            <?= $fichero['data']  ?>
        </p>
        <p>

            <?= $fichero['status']? "true" : "false"; ?>
        </p>
    </div>
</body>

</html>