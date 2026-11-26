<?php
declare(strict_types=1);

namespace Core;

use DirectoryIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class DirectoryIteratorHelper
{
    /** Lista los ficheros (no carpetas) de un directorio: nombre => ruta completa. */
    public static function listFiles(string $dir): array
    {
        $files = [];
        if (!is_dir($dir))
            return $files;

        foreach (new DirectoryIterator($dir) as $item) {
            if ($item->isDot() || !$item->isFile())
                continue;
            $files[$item->getFilename()] = $item->getPathname();
        }
        return $files;
    }

    /** Lista las subcarpetas de un directorio. */
    public static function listDirs(string $dir): array
    {
        $dirs = [];
        if (!is_dir($dir))
            return $dirs;

        foreach (new DirectoryIterator($dir) as $item) {
            if ($item->isDot() || !$item->isDir())
                continue;
            $dirs[] = $item->getFilename();
        }
        return $dirs;
    }

    /** Ficheros con una extensión concreta (ej: 'json', 'txt'). */
    public static function listByExtension(string $dir, string $extension): array
    {
        $extension = strtolower(ltrim($extension, '.'));
        return array_filter(
            self::listFiles($dir),
            fn(string $path) => strtolower(pathinfo($path, PATHINFO_EXTENSION)) === $extension
        );
    }

    /** Busca ficheros cuyo nombre contenga el texto. */
    public static function searchByName(string $dir, string $text): array
    {
        return array_filter(
            self::listFiles($dir),
            fn(string $name) => stripos($name, $text) !== false,
            ARRAY_FILTER_USE_KEY
        );
    }

    /** Busca ficheros cuyo CONTENIDO contenga el texto. */
    public static function searchByContent(string $dir, string $text): array
    {
        return array_filter(
            self::listFiles($dir),
            fn(string $path) => str_contains((string) file_get_contents($path), $text)
        );
    }

    /** Lista recursiva de todos los ficheros (incluye subcarpetas). */
    public static function listRecursive(string $dir): array
    {
        $files = [];
        if (!is_dir($dir))
            return $files;

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
        );
        foreach ($iterator as $item) {
            if ($item->isFile())
                $files[] = $item->getPathname();
        }
        return $files;
    }

    /** Info básica de cada fichero: nombre, extensión, tamaño y fecha. */
    public static function listInfo(string $dir): array
    {
        $info = [];
        if (!is_dir($dir))
            return $info;

        foreach (new DirectoryIterator($dir) as $item) {
            if ($item->isDot() || !$item->isFile())
                continue;
            $info[] = [
                'name'      => $item->getFilename(),
                'extension' => $item->getExtension(),
                'size'      => $item->getSize(),
                'modified'  => date('Y-m-d H:i:s', $item->getMTime()),
                'path'      => $item->getPathname(),
            ];
        }
        return $info;
    }
}
