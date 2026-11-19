<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="nuevoAmigo.php">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="data[nombre]">

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="data[apellido]">
        
        <label for="apellido">Aceptar Teminos</label>
        <input type="checkbox" id="check" name="check">
        <input type="submit" value="Enviar datos">
    </form>
</body>
</html>