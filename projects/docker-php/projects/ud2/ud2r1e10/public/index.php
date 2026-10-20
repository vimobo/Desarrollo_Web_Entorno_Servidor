<<<<<<< HEAD
<?php
include_once("./Persona.php");
$persona = new Persona("vic", 21, "Ciudad Real");

// El método 'getNombre' no existe, así que PHP llama a _ call('getNombre', []) 
echo 'Nombre: '. $persona->getNombre() . '<br>';
// El método 'getEdad' no existe, así que PHP llama a _ call('getEdad', []) 
echo 'Edad: '. $persona->getEdad() . '<br>';
// El método 'getCiudad' no existe, así que PHP llama a _ call('getCiudad', []) 
echo 'Ciudad: ' . $persona->getCiudad() .  '<br>';
// El método 'getHOLA' no existe, PHP llama a _ call('getHOLA', [])
//_call no encontrará la propiedad 'hola', por lo que devuelve el error. echo $persona->getHOLA();
?>
=======
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
>>>>>>> efd58fb1d9ad13069df76eef84d6f97e780ae848
