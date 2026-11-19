<?php
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$check = trim($_POST['check'] ?? '');

echo '<h1>Datos recibidos:</h1>';
echo '<h2>Nombre: ' . htmlspecialchars($nombre) . '</h2>';
echo '<h2>Apellidos: ' . htmlspecialchars($apellido) . '</h2>';
echo '<h2>aceptado: ' . htmlspecialchars($check) . '</h2>'
?>