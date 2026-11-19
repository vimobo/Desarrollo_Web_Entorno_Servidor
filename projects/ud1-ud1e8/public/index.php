<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TablasDeMultiplicar</title>
    </head>
    <body>
        <?php
            $stringFinal = "";

            for($i = 1; $i <= 10; $i++) {
                $stringFinal .= "<table>";
                for($j = 1; $j <= 10; $j++) {
                    $stringFinal .= "<tr><td>" . $i . " x </td><td>". $j . "</td><td> =  " . $j * $i . "</td></tr>"; 
                }
                $stringFinal .= "</table><br>";
            }
            $stringFinal .= ""
        ?>
        <div>
            <?=$stringFinal?>
        </div>
    </body>
</html>