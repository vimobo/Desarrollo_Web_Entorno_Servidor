<?php

    include_once("./Identificable.php");
    class Usuario  {


        use Identificable;
        private string $id;
        private string $prefijo;
        function __construct(
        ){
            $this->prefijo = "USR";
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