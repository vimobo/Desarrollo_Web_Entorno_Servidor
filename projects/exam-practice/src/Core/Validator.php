<?php
declare(strict_types=1);

namespace Core;

class Validator
{
    /** Devuelve un mensaje de error o null si es válido. */

    public static function required(mixed $value, string $label = 'Field'): ?string
    {
        return trim((string) $value) === '' ? "$label is required" : null;
    }

    public static function email(string $value): ?string
    {
        if ($value === '')
            return 'Email is required';

        return filter_var($value, FILTER_VALIDATE_EMAIL) ? null : 'Email is not valid';
    }

    /** Contraseña fuerte: longitud mínima, mayúscula, minúscula y número. */
    public static function password(string $value, int $min = 8): ?string
    {
        if (strlen($value) < $min)
            return "Password must have at least $min characters";
        if (!preg_match('/[A-Z]/', $value))
            return 'Password needs an uppercase letter';
        if (!preg_match('/[a-z]/', $value))
            return 'Password needs a lowercase letter';
        if (!preg_match('/[0-9]/', $value))
            return 'Password needs a number';

        return null;
    }

    //needs to recive a hashed password, confirm should be hashed when stored
    public static function passwordsMatch(string $password, string $confirm): ?string
    {
        return $password === $confirm ? null : 'Passwords do not match';
    }

    public static function minLength(string $value, int $min, string $label = 'Field'): ?string
    {
        return mb_strlen($value) >= $min ? null : "$label must have at least $min characters";
    }

    public static function maxLength(string $value, int $max, string $label = 'Field'): ?string
    {
        return mb_strlen($value) <= $max ? null : "$label must have at most $max characters";
    }

    public static function int(mixed $value, string $label = 'Field'): ?string
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false ? null : "$label must be an integer";
    }

    public static function inList(mixed $value, array $allowed, string $label = 'Field'): ?string
    {
        return in_array($value, $allowed, true) ? null : "$label has an invalid value";
    }

    public static function regex(string $value, string $pattern, string $message): ?string
    {
        return preg_match($pattern, $value) ? null : $message;
    }

    /** Valida un fichero subido ($_FILES['x']): error, tamaño y extensiones permitidas. */
    public static function uploadedFile(array $file, array $extensions, int $maxBytes = 2_000_000): ?string
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK)
            return 'File upload failed';
        if ($file['size'] > $maxBytes)
            return 'File is too big';
        if (!in_array(FileHelper::extension($file['name']), $extensions, true))
            return 'File type not allowed';

        return null;
    }

    /** Ejecuta una lista de comprobaciones y se queda con el primer error. */
    public static function first(?string ...$errors): ?string
    {
        foreach ($errors as $error)
            if ($error !== null)
                return $error;

        return null;
    }

    /** Quita los nulls: deja solo los campos con error. */
    public static function errors(array $results): array
    {
        return array_filter($results, fn($error) => $error !== null);
    }
}
