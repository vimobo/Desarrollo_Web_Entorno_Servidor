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
    function abrirFicheroSiLegible(string $rutaFichero): array
    {
        $respuesta = [];
        $contenido = '';

        if (is_file($rutaFichero)) {

            if (!is_readable($rutaFichero)) {
                $respuesta = [
                    'status' => false,
                    'data' => 'No tienes permisos'
                ];
            } else {
                $f = fopen($rutaFichero, 'r')
                    ?: throw new RuntimeException('No se pudo abrir el archivo');

                try {
                    while (($linea = fgets($f)) !== false) {
                        $contenido .= rtrim($linea, "\r\n") . "\n";
                    }
                } finally {
                    fclose($f);
                }

                $respuesta = [
                    'status' => true,
                    'data' => $contenido
                ];
            }

        } else {
            $respuesta = [
                'status' => false,
                'data' => 'No existe el archivo'
            ];
        }

        return $respuesta;
    }
    $fichero = abrirFicheroSiLegible($ruta);
    //$fichero = abrirFicheroSiLegible($rutaBase . "/wPermision.txt");
    //$fichero = abrirFicheroSiLegible($rutaBase . "/woPermision.txt");
    
    var_dump($fichero);
    ?>

    <div>
        <p>

            <?= $fichero['data'] ?? '' ?>
            <?= $contenido ?? '' ?>
        </p>
        <p>

            <?= $fichero['status'] ? "true" : "false"; ?>
        </p>
    </div>
</body>

</html>