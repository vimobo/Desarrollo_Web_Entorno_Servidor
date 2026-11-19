<?php
declare(strict_types=1);

namespace Requests;

use Controller\ErrorController;
use ErrorException;

class FormRequest
{



    public static function sanitize(string $id): string
    {
        if (isset($id) && is_string($id)) {

            return filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        } else {
            ErrorController::show_error400();
            return "";
        }
    }

    public static function validate(string $id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT)) {

            return filter_var($id, FILTER_VALIDATE_INT);
        }
        else{
            ErrorController::show_error400();
        }
    }

}
?>