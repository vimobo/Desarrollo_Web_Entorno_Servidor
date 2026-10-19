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
