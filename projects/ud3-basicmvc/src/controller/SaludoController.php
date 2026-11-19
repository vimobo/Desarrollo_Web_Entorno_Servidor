<?php
    namespace controller;

    use lib\Pages;

    class SaludoController {
        private $pages;

        public function __construct() {
            $this->pages = new Pages();
        }
        function saludo() {
            return $this->pages->render('saludo');
        }
    }


?>