<?php

//SE PIDE:
//1. Crear una interfaz CalculadorEnvio con el método calcularCosto().
//2. Crear una clase abstracta EnvioBase con las propiedades comunes ($peso, $distancia).
//3. Definir clases hijas (EnvioEstandar, EnvioExpress, EnvioInternacional) con su propia lógica.
//4. Usar características de PHP 8 (constructor property promotion, match).

// Datos de entrada

// FUNCIONES
include_once("./calcularEnvio.php");
include_once("./EnvioEstandar.php");
include_once("./EnvioInternacional.php");
include_once("./EnvioExpres.php");

$envioEstandar = new EnvioEstandar(12, 25);
$envioInternacional = new EnvioInternacional(12, 25);
$envioExpres = new EnvioExpres(12, 25);

$envioEstandar->calcularCosto(10, 10);
$envioInternacional->calcularCosto(10, 10);
$envioExpres->calcularCosto(10, 10);

?>
