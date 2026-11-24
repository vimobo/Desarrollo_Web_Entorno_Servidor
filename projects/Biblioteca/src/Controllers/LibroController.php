<?php
declare(strict_types=1);

namespace Controllers;

use Core\FileHelper;
use Core\Pages;
use EmptyIterator;
use Models\Libro;
use Requests\LibroRequest;

/** Controlador del modelo Libro. */
final class LibroController
{
    /** Muestra el formulario de alta. (YA HECHO) */
    public function create(): void
    {
        new Pages()->render('libro/formulario');
    }

    /** Procesa el alta de un libro. */
    public function store(): void
    {
        // TODO (apartado 4): crear new LibroRequest($_POST, $_FILES).
        //      Si no es válido -> render('libro/formulario') con 'errores' y 'datos', y return.

        $info = $_POST['info'] ?? [];
        $file = $_FILES['portada'] ?? [];
        $libroRequest = new LibroRequest($info, $file);

        if (empty($libroRequest->response['errores'])) {

            $libro = new Libro(
                $libroRequest->response['titulo'],
                $libroRequest->response['autor'],
                $libroRequest->response['genero'],
                $libroRequest->response['anio'],
                $libroRequest->response['paginas'],
                $libroRequest->file['name']
            );

            if (!$libro->existe()) {
                file_put_contents(__DIR__ . "/../../data/foto" . time() . ".png", $file);
                $libro->guardar();

            } else {
                new Pages()->render('libro/formulario', ['errores' => $libroRequest->response['errores'], 'datos' => $libroRequest->response]);

            }

            $this->index();

        } else
            new Pages()->render('libro/formulario', ['errores' => $libroRequest->response['errores'], 'datos' => $libroRequest->response]);


        // TODO (apartado 5):
        //      1. Generar el nombre único de la imagen (todavía no se mueve).
        //      2. Crear el objeto Libro con ese nombre de portada.
        //      3. Si existe() -> render('libro/formulario') con $errores['general'], y return.
        //      4. Mover la imagen a RUTA_IMG.
        //




        // TODO (apartado 6):
        //      guardar() -> render('libro/formulario') con 'mensaje' y 'libro'.
        //      Si falla -> borrar la imagen que ya se había movido y mostrar un error.
    }

    /** Muestra el catálogo. */
    public function index(): void
    {
        $librosString = FileHelper::readLines(RUTA_BIBLIOTECA);
        $libros = [];
        foreach ($librosString as $libro) {
            array_push($libros, json_decode($libro));
        }
        // TODO (apartado 3): rellenar $libros leyendo RUTA_BIBLIOTECA línea por línea
        //      (un array de objetos Libro).

        new Pages()->render('libro/catalogo', ['libros' => $libros]);
    }
}
