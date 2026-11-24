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
        $this->response['titulo'] = Sanitizer::string($this->response['titulo']);
        $this->response['autor'] = Sanitizer::string($this->response['autor']);
        $this->response['genero'] = Sanitizer::string($this->response['genero']);
        $this->response['paginas'] = Sanitizer::int($this->response['paginas']);
        $this->response['anio'] = Sanitizer::int($this->response['anio']);
        $this->file['name'] = Sanitizer::string($this->file['name']);
    }

    public function validate(): void
    {

        $posiblesGeneros = [
            "novela",
            "cienca ficcion",
            "terror"
        ];

        if (empty($this->response['titulo']))
            $this->response['errores']['titulo'] = "El título no puede estar vacio";

        if (empty($this->response['autor']))
            $this->response['errores']['autor'] = "El autor no puede estar vacio";

        if (preg_match('/[\d]/', $this->response['autor']))
            $this->response['errores']['autor'] = "El autor no puede contener carácteres especiales";

        if (!in_array($this->response['genero'], $posiblesGeneros))
            $this->response['errores']['genero'] = "El genero no es uno de la lista";


        if (!is_int($this->response['anio']))
            $this->response['errores']['anio'] = "El año no es un entero";

        if (!is_int($this->response['paginas']))
            $this->response['errores']['paginas'] = "El numero de páginas no es un entero";

        if ($this->response['anio'] < 0)
            $this->response['errores']['anio'] = "Año no es un numero positivo";

        if ($this->response['paginas'] < 0)
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

        if (!isset($this->file)) {


            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($this->file['tmp_name']);

            var_dump($mime);
            var_dump($this->file['tmp_name']);

            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];

            $extension = $extensions[$mime] ?? null;
            var_dump($extension);

            if ($extension === null) {
                $this->response['errores']['extension'] = "Extension incorrecta";
            }
        }

    }

}