<?php
declare(strict_types=1);

require __DIR__ . '/../autoloader.php';


use Models\Baraja;
use Models\Carta;
use Enums\Palo;
use Enums\Valor;

// Creamos una carta
$carta = new Carta(Valor::AS, Palo::OROS);

echo "Carta: $carta<br>";
echo "Número: {$carta->getValor()->value}<br>";
echo "Palo: {$carta->getPalo()->value}<br>";
//echo "Imagen: {$carta->getNombreImagen()}<br><br>";

// Creamos una baraja
$baraja = new Baraja();

echo "Cartas al crear la baraja: {$baraja->totalCartas()}<br>";

$cartas = $baraja->getCartas();

echo "Primera: {$cartas[0]}<br>";
echo "Última: {$cartas[array_key_last($cartas)]}<br><br>";

// Barajamos
$baraja->barajar();

$cartas = $baraja->getCartas();

echo "Primera carta después de barajar: {$cartas[0]}<br><br>";

// Sacamos tres cartas
for ($i = 1; $i <= 3; $i++) {
    $sacada = $baraja->sacarCarta();

    echo "Carta $i: $sacada (quedan {$baraja->totalCartas()})<br>";
}

// Vaciamos la baraja
while ($baraja->totalCartas() > 0) {
    $baraja->sacarCarta();
}

echo "<br>Cartas restantes: {$baraja->totalCartas()}<br>";

// Comprobamos que sacar una carta de una baraja vacía devuelve null
var_dump($baraja->sacarCarta());
?>
