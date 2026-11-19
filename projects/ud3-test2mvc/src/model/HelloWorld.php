<?php 
namespace model;

class  HelloWorld   {

    function __construct(private string $hello = "Hello World") {}

    function helloWorld() {
        return $this->hello;
    }
}


?>