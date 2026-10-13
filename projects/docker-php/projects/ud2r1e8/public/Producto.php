<?php

    include_once("./Identificable.php");
    class Producto  {


        use Identificable;
        private string $id;
        private string $prefijo;
        function __construct(
        ){
            $this->prefijo = "PRD";
            $this->generarId();
        }

        function getPrefijoId():string {
            return $this->prefijo;
        }

        function getId():string {
            return $this->id;
        }

    }
?>