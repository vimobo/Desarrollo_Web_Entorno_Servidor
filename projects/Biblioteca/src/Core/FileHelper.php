<?php
declare(strict_types=1);

namespace Core;

class FileHelper
{
    /** Lee todo el contenido de un fichero. null si no existe. */
    public static function read(string $file): ?string
    {
        if (!is_file($file) || !is_readable($file))
            return null;

        $content = file_get_contents($file);
        return $content === false ? null : $content;
    }

    /** Lee un fichero como array de líneas (sin saltos, sin líneas vacías). */
    public static function readLines(string $file): array
    {
        if (!is_file($file) || !is_readable($file))
            return [];

        return file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    }

    /** Lee línea a línea con fopen/fgets (útil si piden "abrir" el fichero a mano). */
    public static function readWithHandle(string $file): array
    {
        $lines = [];
        $handle = @fopen($file, 'r');
        if ($handle === false)
            return $lines;

        while (($line = fgets($handle)) !== false)
            $lines[] = rtrim($line, "\r\n");

        fclose($handle);
        return $lines;
    }

    /** Sobrescribe el fichero con el contenido. */
    public static function write(string $file, string $content): bool
    {
        return file_put_contents($file, $content, LOCK_EX) !== false;
    }

    /** Añade una línea al final del fichero (crea el fichero si no existe). */
    public static function appendLine(string $file, string $line): bool
    {
        return file_put_contents($file, $line . PHP_EOL, FILE_APPEND | LOCK_EX) !== false;
    }

    /** Devuelve las líneas que contienen el texto (case-insensitive por defecto). */
    public static function searchLines(string $file, string $needle, bool $caseSensitive = false): array
    {
        $found = [];
        foreach (self::readLines($file) as $number => $line) {
            $match = $caseSensitive
                ? str_contains($line, $needle)
                : stripos($line, $needle) !== false;

            if ($match)
                $found[$number + 1] = $line; // clave = nº de línea (desde 1)
        }
        return $found;
    }

    /** true si alguna línea contiene el texto. */
    public static function contains(string $file, string $needle): bool
    {
        return count(self::searchLines($file, $needle)) > 0;
    }

    /** Elimina las líneas que contienen el texto. */
    public static function removeLines(string $file, string $needle): bool
    {
        $kept = array_filter(
            self::readLines($file),
            fn(string $line) => !str_contains($line, $needle)
        );
        return self::write($file, $kept ? implode(PHP_EOL, $kept) . PHP_EOL : '');
    }

    /** Cuenta las líneas del fichero. */
    public static function countLines(string $file): int
    {
        return count(self::readLines($file));
    }

    /** Extensión en minúsculas, sin punto. */
    public static function extension(string $file): string
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }

    /** Crea el directorio si no existe. */
    public static function ensureDir(string $dir): bool
    {
        return is_dir($dir) || mkdir($dir, 0777, true);
    }

    /** Borra el fichero si existe. */
    public static function delete(string $file): bool
    {
        return is_file($file) && unlink($file);
    }
}
