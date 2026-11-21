<?php
declare(strict_types=1);

namespace Repository;

use Core\JsonInFile;
use SeekableIterator;

class UserRepository
{

    public static private(set) string $file = __DIR__ . "/../database/users.json";

    public static function addUserToJson($user): void
    {

        JsonInFile::addToJsonInFile(self::$file, $user->email, $user);
    }

    public static function getUser($email): array
    {

        if (JsonInFile::doesKeyExistInJsonInFile(self::$file, $email))
            return JsonInFile::getValueByKeyInJsonFile(self::$file, $email);
        else
            return [];
    }


}