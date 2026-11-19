<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php
     include_once __DIR__ . "./Cliente.php";
    $cliente1 = new Cliente("juan", "babo", "1234abc");

    printf($cliente1->nombre);
    ?>
</body>
</html>