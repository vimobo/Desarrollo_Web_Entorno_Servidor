<?php
// TODO (apartado 2): vista de la ficha de un libro.
// Recibe la variable $libro (objeto Libro). Solo HTML y PHP para pintar.

//***********************************************************************************
//  CORRECCIÓN
// **********************************************************************************
// La ficha recibe un solo $libro, no el array, el bucle va en el catálogo. También estaba pintando
// la portada donde iba el título, y a la imagen le faltaba la ruta de la carpeta img
?>
<article class="ficha">
    <img src="<?= e(BASE_URL . 'img/' . $libro->portada) ?>" alt="Portada de <?= e($libro->titulo) ?>">
    <h3><?= e($libro->titulo) ?></h3>
    <p class="autor">Por: <?= e($libro->autor) ?></p>
    <span class="genero"><?= e($libro->genero) ?></span>
</article>
