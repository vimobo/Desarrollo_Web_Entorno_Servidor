<?php
declare(strict_types=1);

namespace Core;

use finfo;

/**
 * Subida de ficheros.
 * Uso:
 *   $result = UploadHelper::handle($_FILES['file'], $dir);
 *   // ['errors' => [...], 'fileName' => ?string]
 */
class UploadHelper
{
    public const MAX_SIZE = 10 * 1024 * 1024;

    /** MIME real => extensión permitida. */
    public const ALLOWED = [
        'application/zip' => 'zip',
        'application/pdf' => 'pdf',
        'image/jpeg'      => 'jpg',
        'image/png'       => 'png',
    ];

    /** Valida y guarda. Devuelve ['errors' => [], 'fileName' => nombre guardado | null]. */
    public static function handle(
        array $input,
        string $directory,
        array $allowed = self::ALLOWED,
        int $maxSize = self::MAX_SIZE
    ): array {
        $errors = self::validate($input, $allowed, $maxSize);
        if ($errors)
            return ['errors' => $errors, 'fileName' => null];

        $extension = $allowed[self::mime($input['tmp_name'])];
        $fileName = self::uniqueName($extension);

        if (!self::move($input['tmp_name'], $directory, $fileName))
            return ['errors' => ['move' => 'Could not save the file'], 'fileName' => null];

        return ['errors' => [], 'fileName' => $fileName];
    }

    /** Devuelve array de errores (vacío si es válido). */
    public static function validate(array $input, array $allowed = self::ALLOWED, int $maxSize = self::MAX_SIZE): array
    {
        $errors = [];

        if (($input['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE)
            return ['empty' => 'Upload something...'];

        if ($input['error'] !== UPLOAD_ERR_OK)
            return ['upload' => self::errorMessage($input['error'])];

        if (!is_uploaded_file($input['tmp_name']))
            return ['file' => 'Not a valid uploaded file'];

        if ($input['size'] > $maxSize)
            $errors['size'] = 'File size is above the limit';

        if (!isset($allowed[self::mime($input['tmp_name'])]))
            $errors['extension'] = 'File type not allowed (' . implode(', ', $allowed) . ')';

        return $errors;
    }

    /** MIME real del contenido (no el que dice el navegador). */
    public static function mime(string $path): string
    {
        return (new finfo(FILEINFO_MIME_TYPE))->file($path) ?: '';
    }

    /** Nombre único: timestamp + aleatorio + extensión. */
    public static function uniqueName(string $extension): string
    {
        return time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
    }

    /** Crea el directorio si hace falta y mueve el fichero. */
    public static function move(string $tmp, string $directory, string $fileName): bool
    {
        FileHelper::ensureDir($directory);
        return move_uploaded_file($tmp, rtrim($directory, '/\\') . DIRECTORY_SEPARATOR . $fileName);
    }

    /** Subida de varios ficheros (input name="files[]"): reordena $_FILES a una lista. */
    public static function normalizeMultiple(array $files): array
    {
        $list = [];
        foreach ($files['name'] as $i => $name) {
            $list[] = [
                'name'     => $name,
                'type'     => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error'    => $files['error'][$i],
                'size'     => $files['size'][$i],
            ];
        }
        return $list;
    }

    public static function errorMessage(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'File exceeds the allowed size',
            UPLOAD_ERR_PARTIAL                        => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE                        => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR, UPLOAD_ERR_CANT_WRITE => 'Server error saving the file',
            default                                   => 'Upload has failed',
        };
    }
}
