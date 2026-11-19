<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DibujarLinea</title>
</head>
<body>
    <?php
        $height = isset($_GET["height"]) ? (float) $_GET["height"] : null;
        $width = isset($_GET["width"]) ? (float) $_GET["width"] : null;

        if ($height <= 1000 && $height >= 10 && $width <= 1000 && $width >= 10 ) {

        }   
    ?>

        <div style="background-color: black; width: <?=$width?>px; height: <?=$height?>px;">.</div>
</body>
</html>