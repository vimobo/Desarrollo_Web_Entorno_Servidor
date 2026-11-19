<?php

class Class2 {

//se pueden declarar atributos dentro del constructor directamente

    public function __construct(
        public string $name,
        public int $age
        ) {}
    }

?>