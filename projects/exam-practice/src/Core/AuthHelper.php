<?php
declare(strict_types=1);

namespace Core;

/**
 * Registro / login con usuarios guardados en un JSON (clave = email).
 * Uso:
 *   $errors = AuthHelper::register($file, $_POST);
 *   $result = AuthHelper::login($file, $_POST);  // ['errors'=>[], 'user'=>?array]
 */
class AuthHelper
{
    public static function register(string $file, array $post): array
    {
        $data = Sanitizer::fields($post, [
            'email' => 'email', 'password' => 'password', 'confirm' => 'password',
        ]);

        $errors = Validator::errors([
            'email'    => Validator::email($data['email']),
            'password' => Validator::password($data['password']),
            'confirm'  => Validator::passwordsMatch($data['password'], $data['confirm']),
        ]);

        if (!isset($errors['email']) && JsonInFile::doesKeyExistInJsonInFile($file, $data['email']))
            $errors['email'] = 'Email already registered';

        if (!$errors) {
            JsonInFile::addToJsonInFile($file, $data['email'], [
                'email'    => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ]);
        }

        return $errors;
    }

    public static function login(string $file, array $post): array
    {
        $data = Sanitizer::fields($post, ['email' => 'email', 'password' => 'password']);

        $errors = Validator::errors([
            'email'    => Validator::email($data['email']),
            'password' => Validator::required($data['password'], 'Password'),
        ]);

        if ($errors)
            return ['errors' => $errors, 'user' => null];

        $user = JsonInFile::getValueByKeyInJsonFile($file, $data['email']);

        // Mensaje genérico: no revelar si falla el email o la contraseña
        if (!$user || !password_verify($data['password'], $user['password']))
            return ['errors' => ['login' => 'Invalid email or password'], 'user' => null];

        return ['errors' => [], 'user' => ['email' => $user['email']]];
    }

    public static function startSession(array $user): void
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        session_regenerate_id(true);
        $_SESSION['user'] = $user;
    }

    public static function isLogged(): bool
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        return isset($_SESSION['user']);
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        $_SESSION = [];
        session_destroy();
    }
}
