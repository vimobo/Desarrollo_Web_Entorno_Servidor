<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiccionarioDeNumeros</title>
</head>
<body>
    <?php
    $diccionarioEn = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"];
    $diccionarioEs = ["uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve", "diez"];
    $stringFinal = "";

    for($i = 0; $i < count($diccionarioEn); $i++){
    
        $stringFinal .= "<tr> <td>". $diccionarioEn[$i] ." </td> ";
        $stringFinal .= "<td>". $diccionarioEs[$i] ." </td> </tr>";
    }
    ?>

    <table>
        <?= $stringFinal ?>
    </table>
</body>
</html>