<h1>Catálogo</h1>

<?php
// TODO (apartado 3): recibe la variable $libros (array de objetos Libro).
// Recórrela y pinta cada ficha reutilizando imprimeFicha.php.
// Si no hay libros, muestra «Todavía no hay libros en la biblioteca».
?>


<?php if (!empty($libros)): ?>
    <?php foreach ($libros as $libro): ?>

        <article class="ficha">
            <img src="<?=__DIR__ . "/../../public/img/" . $libro->portada ?>" alt="Portada">
            <h3><?= $libro->titulo ?></h3>
            <p class="autor">Escrito por <?= $libro->autor ?></p>
            <span class="genero">Escrito por <?= $libro->genero ?></span>
        </article>

    <?php endforeach; ?>
<?php else: ?>
    <p>
        No hay libros disponibles.
    </p>
<?php endif; ?>