<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricula</title>
</head>

<body>
    <?php
    $matricula = isset($_POST["matricula"]) ? $_POST["matricula"] : "null";

    
    function comprobarMatricula($contrasenia)
    {
        $regex = "/^[0-9]{4}[A-Z]{3}$/";
        return preg_match($regex , $contrasenia);
    }

    function imprimirMatriculaValido ($isValid){
        $respuesta = "";
        if($isValid) 
            $respuesta = "Matricula Valida";
        else
            $respuesta = "Matricula Invalida";

        return $respuesta;
    }
    ?>


    <div>
        <form method="POST">
            <label for="matricula">Matricula</label>
            <input type="text" id="matricula" name="matricula">
            <input type="submit">
        </FORM>
        <p>
            <?= comprobarMatricula($matricula) ?>
            <?= imprimirMatriculaValido(comprobarMatricula($matricula)) ?>

        </p>
    </div>
</body>

</html>