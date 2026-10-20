<?php

require_once __DIR__ . ("./Persona.php");

class Persona {

    public function __construct(public string $nombre,
                                public string $apellidos) {

    }
}
?>