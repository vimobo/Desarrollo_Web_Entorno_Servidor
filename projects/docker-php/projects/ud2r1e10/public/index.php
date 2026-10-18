<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php

    include_once("./Persona.php");
$persona = new Persona("vic" ,21 ,"victoria");
    echo($persona->getNombre());
    echo($persona->getApellidos());
    echo($persona->getEdad());
    ?>
</body>
</html>