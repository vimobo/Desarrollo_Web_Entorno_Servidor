<?php

require_once __DIR__ .  './Persona.php';
class Cliente extends Persona {

    private string $codigo;

    public function __construct(string $nombre, string $apellidos, string $codigo) {
        parent::__construct($nombre, $apellidos);
        $this -> codigo = $codigo;
    }
}
?>