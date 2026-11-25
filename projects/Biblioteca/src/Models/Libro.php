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

    public function existe(): bool
    {
        $frase = "'titulo':'" . $this->titulo . "','autor':'" . $this->autor . "'";
        return !empty(FileHelper::searchLines(RUTA_BIBLIOTECA, $frase, true));

    }

    public function guardar()
    {
            $object =  json_encode($this, JSON_UNESCAPED_UNICODE);
            var_dump($object);
            $objectTail = FileHelper::read(RUTA_BIBLIOTECA);
            FileHelper::write(RUTA_BIBLIOTECA, $objectTail . $object);
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