<?php
declare(strict_types=1);

namespace Requests;

class FormRequest
{



    public static function sanitize(array $response): array
    {


        $response['firstName'] = htmlspecialchars(trim($response['firstName'] ?? ''), ENT_QUOTES, 'UTF-8');
        $response['surname'] = htmlspecialchars(trim($response['surname'] ?? ''), ENT_QUOTES, 'UTF-8');
        $response['mail'] = htmlspecialchars(trim($response['mail'] ?? ''), ENT_QUOTES, 'UTF-8');
        $response['phone'] = htmlspecialchars(trim($response['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
        $response['url'] = htmlspecialchars(trim($response['url'] ?? ''), ENT_QUOTES, 'UTF-8');
        $response['ocupation'] = htmlspecialchars(trim($response['ocupation'] ?? ''), ENT_QUOTES, 'UTF-8');

        $languages = $response['languages'] ?? [];

        if (is_array($languages)) {
            $languages = array_map(
                fn($language) => trim(strip_tags($language)),
                $languages
            );
        } else {
            $languages = [];
        }
        return $response;
    }

    public static function validate(array $response): array
    {

        $response['errors'] = [];

        $posibleOcupation = [
            "unemployed",
            "half",
            "full"
        ];

        $posibleLanguages = [
            "Python",
            "PHP",
            "JavaScript",
            "Java",
            "C++"
        ];

        if (isset($response)) {

            if (!preg_match('/^[a-zA-Z]+$/', $response['firstName'])) {
                $response['errors']['firstName'] = "Name must be text";
            }

            if (!preg_match('/^[a-zA-Z]+$/', $response['surname'])) {
                $response['errors']['surname'] = "Last ame must be text";
            }

            if (!preg_match('/^[0-9]{9}$/', $response['phone'] ?? '')) {
                $response['errors']['phone']['type'] = "Phone must contain 9 digits";
            }

            if (!filter_var($response['url'], FILTER_VALIDATE_URL)) {
                $response['errors']['url'] = "Not a valid URL";
            }

            if (!filter_var($response['mail'], FILTER_VALIDATE_EMAIL)) {
                $response['errors']['mail'] = "Not a valid mail";
            }

            if (!in_array($response['ocupation'] ?? '', $posibleOcupation, true)) {
                $response['errors']['ocupation'] = "Occupation is not valid";
            }

            $languages = $response['languages'] ?? [];

            if (is_array($languages)) {
                $response['languages'] = array_map(
                    fn($language) => trim(strip_tags($language)),
                    $languages
                );
            } else {
                $response['languages'] = [];
            }


        } else {
            $response['errors']['empty'] = "You need to fill the form";
        }
        return $response;
    }

}
?>