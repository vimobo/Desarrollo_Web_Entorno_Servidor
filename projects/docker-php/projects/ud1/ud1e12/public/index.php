<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FechaSumaYResta</title>
    </head>
    <body>
        <?php
        
            $fechaActual = date("d/m/y");
            $fechaAyer = date("d/m/y", strtotime("-1 day"));
            $fechaManiana = date("d/m/y", strtotime("+1 day"));
            //$fechaManiana = strtotime(+1day,$fechaActual);
           // $fechaAyer = strtotime("d/m/y", "yesterday");
        ?>
        <p>
            Ayer: <?=$fechaAyer?>
        </p>
        <p>
            Hoy: <?=$fechaActual?>
        </p>
        <p>
           Mañana: <?=$fechaManiana?>
        </p>
    </body>
</html>