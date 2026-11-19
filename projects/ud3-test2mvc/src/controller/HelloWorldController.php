<?php
namespace controller;

use model\HelloWorld;
use lib\Pages;

class HelloWorldController
{

    function saludar()
    {
        $hello = new HelloWorld();
        $page = new Pages();
        $page->render('main', ['hello' => $hello->helloWorld()]);
    }

}


?>