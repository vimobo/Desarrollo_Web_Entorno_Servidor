<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complementario</title>
</head>
<body>
    <?php
    
    $binary = array_fill(0,10,0);
    $binaryComplementary[] = 0;

        for($i = 0; $i < count($binary); $i++) {
            $binary[$i] = rand(0,1);
            if ($binary[$i] == 1) 
                $binaryComplementary[$i] = 0;
            else
                $binaryComplementary[$i] = 1;
        }

        echo(print_r($binary));
        echo "<br>";
        echo(print_r($binaryComplementary));
    
    ?>
</body>
</html>