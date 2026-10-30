<?php

namespace Controllers;

use Lib\Pages;
use Models\Triangulo;


class TrianguloController
{

    private Triangulo $triangulo;
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
        $this->triangulo = new Triangulo(0, 0);
    }

    public function showForm()
    {
        $this->pages->render('form/form');
    }

    public function process(): void
    {

    
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->pages->render('form/form');
            return;
        }

        $this->triangulo->setHeigth($_POST['data']['height']);
        $this->triangulo->setWidth($_POST['data']['width']);
        $area = $this->triangulo->calculateArea();
        $this->pages->render('form/formResponse', ['area' => $area]);
    }


}
?>