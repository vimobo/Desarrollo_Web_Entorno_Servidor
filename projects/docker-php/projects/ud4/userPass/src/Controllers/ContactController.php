<?php

declare(strict_types=1);

namespace Controllers;

use Requests\ContactRequest;
use Models\Contact;
use Lib\Pages;

// ----------------------------------------------------------
// CLASSES
// ----------------------------------------------------------

class ContactController
{
    // ----------------------------------------------------------
    // ATTRIBUTES
    // ----------------------------------------------------------

    private Pages $pages;

    // ----------------------------------------------------------
    // CONSTRUCTORS
    // ----------------------------------------------------------

    public function __construct()
    {
        $this->pages = new Pages();
    }

    // ----------------------------------------------------------
    // METHODS
    // ----------------------------------------------------------

    public function showForm(): void
    {
        $this->pages->render('form/form');
    }

    public function process(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            
        }
        else {
            $this->showForm();
            return;
            var_dump($_POST);
            $resultado = ContactRequest::sanearYValidar($_POST);

            $request = $resultado['request'];
            $errores = $resultado['errores'];

            if (empty($errores)) {
                echo "Formulario válido";

                $this->pages->render('form/form', $errores);

            } else {
                foreach ($errores as $campo => $mensaje) {
                    echo $mensaje . "<br>";
                }
            }
        }

        $contact = ContactRequest::sanearYValidar($_POST['data'] ?? []);
        $this->pages->render('form/response', ['contact' => $contact]);
    }
}