<?php
declare(strict_types=1);

namespace Core;

class JsonInFile
{
    private static int $JSON_FLAGS = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    public static function getDataFromJsonInFile(string $file) : array
    {
        $dataFound = [];

        if (is_file($file))
            $dataFound = json_decode(file_get_contents($file), true) ?: [];

        return $dataFound;
    }

    public static function getValueByKeyInJsonFile(string $file, mixed $key) : mixed
    {
        return self::getDataFromJsonInFile($file)[$key] ?? null;
    }

    public static function doesKeyExistInJsonInFile(string $file, mixed $key) : bool
    {
        return !is_null(self::getValueByKeyInJsonFile($file, $key));
    }

    public static function addToJsonInFile(string $file, string $key, mixed $content) : void
    {
        $jsonInside = self::getDataFromJsonInFile($file);
        $jsonInside[$key] = $content;
        $jsonInside = json_encode((object)$jsonInside, self::$JSON_FLAGS);
        
        file_put_contents($file, $jsonInside);
    }

    /** Guarda un array completo, sobrescribiendo el fichero. */
    public static function saveAll(string $file, array $data): bool
    {
        return file_put_contents($file, json_encode((object) $data, self::$JSON_FLAGS), LOCK_EX) !== false;
    }

    /** Elimina una clave. Devuelve false si no existía. */
    public static function removeFromJsonInFile(string $file, string $key): bool
    {
        $data = self::getDataFromJsonInFile($file);
        if (!array_key_exists($key, $data))
            return false;

        unset($data[$key]);
        return self::saveAll($file, $data);
    }

    /** Actualiza campos de un registro existente (merge). Devuelve false si no existe. */
    public static function updateInJsonInFile(string $file, string $key, array $changes): bool
    {
        $data = self::getDataFromJsonInFile($file);
        if (!isset($data[$key]) || !is_array($data[$key]))
            return false;

        $data[$key] = array_merge($data[$key], $changes);
        return self::saveAll($file, $data);
    }

    /** Todos los registros cuyo campo $field sea igual a $value. clave => registro. */
    public static function findByField(string $file, string $field, mixed $value): array
    {
        return array_filter(
            self::getDataFromJsonInFile($file),
            fn($item) => is_array($item) && ($item[$field] ?? null) == $value
        );
    }

    /** Primer registro cuyo campo coincide, o null. */
    public static function findFirstByField(string $file, string $field, mixed $value): ?array
    {
        return array_values(self::findByField($file, $field, $value))[0] ?? null;
    }

    /** Registros cuyo campo contiene el texto (case-insensitive). */
    public static function searchByField(string $file, string $field, string $text): array
    {
        return array_filter(
            self::getDataFromJsonInFile($file),
            fn($item) => is_array($item) && stripos((string) ($item[$field] ?? ''), $text) !== false
        );
    }

    /** Lee un JSON que es una lista (array indexado) en vez de clave => valor. */
    public static function getList(string $file): array
    {
        return array_values(self::getDataFromJsonInFile($file));
    }

    /** Añade un elemento al final de una lista JSON. */
    public static function appendToList(string $file, mixed $item): bool
    {
        $list = self::getList($file);
        $list[] = $item;
        return file_put_contents($file, json_encode($list, self::$JSON_FLAGS), LOCK_EX) !== false;
    }

    /** Elimina de una lista JSON los elementos cuyo campo coincide. */
    public static function removeFromListByField(string $file, string $field, mixed $value): bool
    {
        $list = array_values(array_filter(
            self::getList($file),
            fn($item) => !(is_array($item) && ($item[$field] ?? null) == $value)
        ));
        return file_put_contents($file, json_encode($list, self::$JSON_FLAGS), LOCK_EX) !== false;
    }
}