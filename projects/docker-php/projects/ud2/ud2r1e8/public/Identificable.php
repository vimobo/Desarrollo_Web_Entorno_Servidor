<?php
    trait Identificable {
        public function generarId() {
            $numero = rand(1000, 9999);
            $this->id = $this->getPrefijoId() . $numero;
        }
    }
?>