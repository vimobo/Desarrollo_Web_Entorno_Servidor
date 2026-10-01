<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Asociativos</title>
</head>
<body>
    <?php
        $paises = [
            'España' => 1000,
            'Francia' => 905,
            'Mallorca' => 10,
            'Guarica' => 100
        ];
        $diccionario = [
            'Hola' => 'Hello',
            'Adios' => 'Bye'
        ];

        function imprimirArray($array) {
            $tabla = "<table><tr><td>Clave</td><td>Valor</td></tr>";
            foreach($array as $clave => $valor) {
                $tabla .= "<tr><td>" . $clave . "</td><td>" . $valor . "</td><tr>";
            }
            $tabla .= "</table>";

            return $tabla;
        }
    ?>
<p>
    <?=imprimirArray($paises)?>
    <?=imprimirArray($diccionario)?>
</p>

</body>
</html>