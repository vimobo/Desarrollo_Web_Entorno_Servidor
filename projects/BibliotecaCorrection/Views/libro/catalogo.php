<h1>Catálogo</h1>

<?php
// TODO (apartado 3): recibe la variable $libros (array de objetos Libro).
// Recórrela y pinta cada ficha reutilizando imprimeFicha.php.
// Si no hay libros, muestra «Todavía no hay libros en la biblioteca».

//***********************************************************************************
//  CORRECCIÓN
// **********************************************************************************
// Repetía aquí el html de la ficha en vez de reutilizar imprimeFicha.php, y en el src ponía __DIR__,
// que es la ruta del disco y el navegador no la puede cargar
?>

<?php if (!empty($libros)): ?>
    <div class="galeria">
        <?php foreach ($libros as $libro): ?>
            <?php require __DIR__ . '/imprimeFicha.php'; ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Todavía no hay libros en la biblioteca</p>
<?php endif; ?>
