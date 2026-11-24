<?php
// TODO (apartado 2): vista de la ficha de un libro.
// Recibe la variable $libro (objeto Libro). Solo HTML y PHP para pintar.
?>
<?php if (!empty($libros)): ?>
    <?php foreach ($libros as $libro): ?>

        <article class="ficha">
            <img src="<?= $libro['portada'] ?>" alt="Portada">
            <h3><?= $libro['portada'] ?></h3>
            <p class="autor">Escrito por <?= $libro['autor'] ?></p>
            <span class="genero">Escrito por <?= $libro['genero'] ?></span>
        </article>

    <?php endforeach; ?>
<?php endif; ?>