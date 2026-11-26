<?php
declare(strict_types=1);

namespace Models;

use Core\FileHelper;
use Core\JsonInFile;

class Libro
{


    public readonly string $titulo;
    public readonly string $autor;
    public readonly string $genero;
    public readonly int $anio;
    public readonly int $paginas;
    public readonly string $portada;


    public function __construct($titulo, $autor, $genero, $anio, $paginas, $portada)
    {

        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->genero = $genero;
        $this->anio = $anio;
        $this->paginas = $paginas;
        $this->portada = $portada;
    }

    //***********************************************************************************
    //  CORRECCIÓN
    // **********************************************************************************
    // Buscaba el texto con comillas simples y en el json van dobles, así que nunca encontraba nada
    // y dejaba repetir libros. Ahora leo línea a línea y comparo título y autor en minúsculas y sin
    // los espacios de los lados
    public function existe(): bool
    {
        foreach (FileHelper::readLines(RUTA_BIBLIOTECA) as $linea) {
            $datos = json_decode($linea, true);
            if ($datos === null)
                continue;

            if (
                mb_strtolower(trim($datos['titulo'])) === mb_strtolower(trim($this->titulo))
                && mb_strtolower(trim($datos['autor'])) === mb_strtolower(trim($this->autor))
            )
                return true;
        }

        return false;
    }

    //***********************************************************************************
    //  CORRECCIÓN
    // **********************************************************************************
    // Reescribía el fichero pegando el libro nuevo justo detrás del último, todo en la misma línea,
    // y luego el catálogo no podía leerlo. Uso appendLine, que además devuelve true o false.
    // Si el fichero no acaba en salto de línea se lo pongo antes
    public function guardar(): bool
    {
        $linea = json_encode($this, JSON_UNESCAPED_UNICODE);
        $contenido = FileHelper::read(RUTA_BIBLIOTECA) ?? '';

        if ($contenido !== '' && !str_ends_with($contenido, "\n"))
            $linea = PHP_EOL . $linea;

        return FileHelper::appendLine(RUTA_BIBLIOTECA, $linea);
    }


    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($value)
    {
        $this->titulo = $value;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($value)
    {
        $this->autor = $value;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($value)
    {
        $this->genero = $value;
    }

    public function getAnio()
    {
        return $this->anio;
    }

    public function setAnio($value)
    {
        $this->anio = $value;
    }

    public function getPaginas()
    {
        return $this->paginas;
    }

    public function setPaginas($value)
    {
        $this->paginas = $value;
    }

    public function getPortada()
    {
        return $this->portada;
    }

    public function setPortada($value)
    {
        $this->portada = $value;
    }
}