<?php
declare(strict_types=1);

namespace Core;

class Sanitizer
{
    /** Texto genérico: trim + elimina etiquetas + escapa HTML. */
    public static function string(mixed $value): string
    {
        return htmlspecialchars(strip_tags(trim((string) $value)), ENT_QUOTES, 'UTF-8');
    }

    /** Email: trim, minúsculas y sin caracteres inválidos. */
    public static function email(mixed $value): string
    {
        return (string) filter_var(strtolower(trim((string) $value)), FILTER_SANITIZE_EMAIL);
    }

    /** Contraseña: solo trim (NO escapar, se hashea después). */
    public static function password(mixed $value): string
    {
        return trim((string) $value);
    }

    public static function int(mixed $value): int
    {
        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function float(mixed $value): float
    {
        return (float) filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function url(mixed $value): string
    {
        return (string) filter_var(trim((string) $value), FILTER_SANITIZE_URL);
    }

    /** Nombre de fichero seguro (sin rutas ni caracteres raros). */
    public static function filename(mixed $value): string
    {
        $name = basename(trim((string) $value));
        return preg_replace('/[^A-Za-z0-9._-]/', '_', $name);
    }

    /** Sanea un array completo con un mapa campo => tipo. Campos ausentes -> ''. */
    public static function fields(array $data, array $rules): array
    {
        $clean = [];
        foreach ($rules as $field => $type) {
            $value = $data[$field] ?? '';
            $clean[$field] = match ($type) {
                'email'    => self::email($value),
                'password' => self::password($value),
                'int'      => self::int($value),
                'float'    => self::float($value),
                'url'      => self::url($value),
                'filename' => self::filename($value),
                default    => self::string($value),
            };
        }
        return $clean;
    }
}
