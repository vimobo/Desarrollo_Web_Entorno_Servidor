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

            //***********************************************************************************
            //  CORRECCIÓN
            // **********************************************************************************
            // En portada guardaba el nombre original del fichero, pero la imagen la creaba con otro nombre,
            // así que nunca coincidían. Ahora genero primero un nombre único y uso ese en los dos sitios
            $nombrePortada = uniqid() . '.' . $libroRequest->response['extension'];

            $libro = new Libro(
                $libroRequest->response['titulo'],
                $libroRequest->response['autor'],
                $libroRequest->response['genero'],
                $libroRequest->response['anio'],
                $libroRequest->response['paginas'],
                $nombrePortada
            );

            if (!$libro->existe()) {

                //***********************************************************************************
                //  CORRECCIÓN
                // **********************************************************************************
                // Con file_put_contents le estaba pasando el array $_FILES, y lo que se creaba era un png de
                // unos pocos bytes que no se abría. La imagen subida se mueve con move_uploaded_file.
                // Si guardar() falla borro la imagen, y si va bien muestro el mensaje y la ficha (antes iba al catálogo)
                $destino = RUTA_IMG . $nombrePortada;

                if (!move_uploaded_file($libroRequest->file['tmp_name'], $destino)) {
                    new Pages()->render('libro/formulario', ['errores' => ['general' => 'No se ha podido subir la imagen'], 'datos' => $libroRequest->response]);
                } elseif ($libro->guardar()) {
                    new Pages()->render('libro/formulario', ['mensaje' => '¡Libro registrado correctamente!', 'libro' => $libro]);
                } else {
                    unlink($destino);
                    new Pages()->render('libro/formulario', ['errores' => ['general' => 'No se ha podido guardar el libro'], 'datos' => $libroRequest->response]);
                }

            } else {

                new Pages()->render('libro/formulario', ['errores' => ['general' => 'Este libro ya está registrado'], 'datos' => $libroRequest->response]);

            }


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
        //***********************************************************************************
        //  CORRECCIÓN
        // **********************************************************************************
        // json_decode a secas devuelve un objeto genérico y tenían que ser objetos Libro.
        // Además, si hay alguna línea rota en el fichero me la salto para que no pete el catálogo
        foreach ($librosString as $linea) {
            $datos = json_decode($linea, true);
            if ($datos === null)
                continue;

            $libros[] = new Libro(
                $datos['titulo'],
                $datos['autor'],
                $datos['genero'],
                $datos['anio'],
                $datos['paginas'],
                $datos['portada']
            );
        }
        // TODO (apartado 3): rellenar $libros leyendo RUTA_BIBLIOTECA línea por línea
        //      (un array de objetos Libro).

        new Pages()->render('libro/catalogo', ['libros' => $libros]);
    }
}
