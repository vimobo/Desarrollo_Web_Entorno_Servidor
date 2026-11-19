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
    // Comprobar que sea POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->showForm();
        return;
    }

    // Validar formulario
    $resultado = ContactRequest::sanearYValidar($_POST['data']);

    $request = $resultado['request'];
    $errores = $resultado['errores'];

    // Comprobar errores
    if (!empty($errores)) {
        $this->pages->render('form/form', [
            'errores' => $errores,
            'request' => $request
        ]);
        return;
    }

    // Mostrar respuesta
    $this->pages->render('form/response', [
        'contact' => $request->username
    ]);
    }
}