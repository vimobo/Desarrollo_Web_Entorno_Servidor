<?php 
declare(strict_types=1);

namespace Requests;

class SanitizeUser {
    public static function sanitizeUser(&$response): void {
        $response['email'] = htmlspecialchars(trim($response['email']));
        $response['password'] = htmlspecialchars(trim($response['password']));
    }
    
}