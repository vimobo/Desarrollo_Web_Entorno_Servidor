<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ConversionEnDiferentesBases</title>
    </head>
    <body>
        <?php
            $stringFinal = "<table style='width: 300px; height: 300px; text-align: center; border: 1px solid black'>
                                <tr>
                                    <td>Decimal</td> 
                                    <td>Binario</td>
                                    <td>Octal</td>
                                    <td>Hexadecimal</td>
                                </tr>";
            
            for($i = 1; $i <= 20; $i++) {
                $stringFinal .= "<tr>
                                    <td>" . $i ."</td> 
                                    <td>" . decbin(number_format($i, 2)) . "</td> 
                                    <td>" . decoct(number_format($i, 2)) . "</td> 
                                    <td>" . dechex(number_format($i, 2)) . "</td>
                                </tr>";
            }

            $stringFinal .= "</table><td>";
        ?>
        <div>
            <?=$stringFinal?>
        </div>
    </body>
</html>