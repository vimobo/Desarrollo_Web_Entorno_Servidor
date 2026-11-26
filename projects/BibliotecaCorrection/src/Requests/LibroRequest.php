<?php

declare(strict_types=1);

namespace Requests;

use Core\Sanitizer;
use finfo;

class LibroRequest
{

    public private(set) array $response;
    public private(set) array $file;


    public function __construct(array $response, array $file)
    {

        $this->response = $response;
        $this->file = $file;

        $this->sanitize();
        $this->validate();
        $this->validateFile();
    }

    public function sanitize(): void
    {
        //***********************************************************************************
        //  CORRECCIÓN
        // **********************************************************************************
        // Antes usaba Sanitizer::string, que ya escapa el html, y como en las vistas se vuelve a escapar con e()
        // un apóstrofe o un & salían escritos raros. Aquí solo quito espacios y etiquetas, y se escapa al pintar.
        // El ?? '' es para que no salte un aviso si el campo no llega
        $this->response['titulo'] = strip_tags(trim((string) ($this->response['titulo'] ?? '')));
        $this->response['autor'] = strip_tags(trim((string) ($this->response['autor'] ?? '')));
        $this->response['genero'] = strip_tags(trim((string) ($this->response['genero'] ?? '')));
        $this->response['paginas'] = Sanitizer::int($this->response['paginas'] ?? '');
        $this->response['anio'] = Sanitizer::int($this->response['anio'] ?? '');
        $this->file['name'] = Sanitizer::string($this->file['name']);
    }

    public function validate(): void
    {

        if (empty($this->response['titulo']))
            $this->response['errores']['titulo'] = "El título no puede estar vacio";

        if (empty($this->response['autor']))
            $this->response['errores']['autor'] = "El autor no puede estar vacio";

        if (preg_match('/[\d]/', $this->response['autor']))
            $this->response['errores']['autor'] = "El autor no puede contener carácteres especiales";

        //***********************************************************************************
        //  CORRECCIÓN
        // **********************************************************************************
        // Había hecho mi propia lista de géneros y puse "cienca ficcion", mal escrito y sin tilde, así que
        // al elegir ciencia ficción en el formulario siempre daba error. Uso GENEROS de config.php, que es
        // la misma lista que pinta el select
        if (!in_array($this->response['genero'], GENEROS))
            $this->response['errores']['genero'] = "El genero no es uno de la lista";


        if (!is_int($this->response['anio']))
            $this->response['errores']['anio'] = "El año no es un entero";

        if (!is_int($this->response['paginas']))
            $this->response['errores']['paginas'] = "El numero de páginas no es un entero";


        if ($this->response['anio'] <= 0)
            $this->response['errores']['anio'] = "Año no es un numero positivo";

        if ($this->response['paginas'] <= 0)
            $this->response['errores']['paginas'] = "Paginas no es un numero positivo";

    }

    public function validateFile()
    {
        define('MAX_SIZE', 1024 * 500);

        if ($this->file['name'] == '') {
            $this->response['errores']['empty'] = "Fichero vacio";
        }

        if ($this->file['error'] != UPLOAD_ERR_OK) {
            $this->response['errores']['size'] = "Subida fallida";
        }

        if (!is_uploaded_file($this->file['tmp_name'])) {
            $this->response['errores']['file'] = "no es archivo válido";
        }

        if ($this->file['size'] > MAX_SIZE) {
            $this->response['errores']['size'] = "Tamaño demasiado grande.";
        }

        //***********************************************************************************
        //  CORRECCIÓN
        // **********************************************************************************
        // Aquí el error es que se miraba con isset si $this->file, porque al usar empty de file, no da true cuando no hay ningún archivo, ya que el array como tal existe
        // pero sus campos no tiene nada dentro, por tanto el arreglo era comprobar empty de file[tmp_name] en lugar de file
        //  nunca entraba en el if y colaba cualquier fichero.
        // También he quitado los var_dump, he añadido webp que lo pedía el enunciado y me guardo la extensión
        // para ponerle nombre a la imagen en el controlador
        //  */
        if (!empty($this->file['tmp_name'])) {


            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($this->file['tmp_name']);

            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];

            $extension = $extensions[$mime] ?? null;

            if ($extension === null) {
                $this->response['errores']['extension'] = "Extension incorrecta";
            } else {
                $this->response['extension'] = $extension;
            }
        }

    }

}