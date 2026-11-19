<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php
//creamos variables
$pais = "Spain";
$habitantes = 10000;
define ("CONTINENTE" , "Europa");

echo($pais. " " .$habitantes. " " . CONTINENTE );
echo($pais. " es de tipo . get " .$habitantes. " " . CONTINENTE );

//creamos una consonante y operamos con las variables
$euros = 100;
define ("FACTOR_CONVERSION" , 0.85);

$dolaresTotal = $euros * FACTOR_CONVERSION;
echo($euros . " € son ". $dolaresTotal."$")

?>

</body>
</html>