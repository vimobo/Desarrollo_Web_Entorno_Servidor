<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contraseña</title>
</head>

<body>
    <?php
    $pass = isset($_POST["pass"]) ? $_POST["pass"] : "null";
    
    function comprobarPassword($contrasenia)
    {
        $arrayRegex = [
            '/^.{6,15}$/',
            '/[0-9]/',
            '/[a-z]/',
            '/[A-Z]/',
            '/^[a-zA-Z]/'
        ];
        
        $cumple = true;

        foreach ($arrayRegex as $regex) {
            if (!preg_match($regex, $contrasenia)) 
                $cumple = false;
        }
        return $cumple;
    }

    function imprimirPassValido ($isValid){
        $respuesta = "";
        if($isValid) 
            $respuesta = "Contraseña Valida";
        else
            $respuesta = "Contraseña Invalida";

        return $respuesta;
    }
    ?>


    <div>
        <form method="POST">
            <label for="pass">Contraseña</label>
            <input type="text" id="pass" name="pass">
            <input type="submit">
        </FORM>
        <p>
            <?= comprobarPassword($pass) ?>
            <?= imprimirPassValido(comprobarPassword($pass)) ?>

        </p>
    </div>
</body>

</html>