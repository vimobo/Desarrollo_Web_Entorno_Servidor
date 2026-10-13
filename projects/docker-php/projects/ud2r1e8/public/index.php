<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traits</title>
</head>
<body>
    <?php
    include_once("./Usuario.php");
    include_once("./Producto.php");
        $u1 = new Usuario();
        $p1 = new Producto();

        echo($u1->getId());
        echo($p1->getId());
    ?>
</body>
</html>