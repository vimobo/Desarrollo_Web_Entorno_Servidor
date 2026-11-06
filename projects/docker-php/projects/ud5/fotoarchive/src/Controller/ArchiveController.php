<?php
declare(strict_types=1);

namespace Controller;
use Models\Archive;
use Lib\Pages;
use Requests\ArchiveRequest;


class ArchiveController
{

    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
    }

    function start()
    {
        $archivo = new ArchiveRequest();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!$archivo->validateImg()) {
                $array = Archive::printImg();
                $this->pages->render('form/form', ['array' => $array, 'errors' => $archivo->getErrors()]);

            } else {
                $array = Archive::printImg();
                $this->pages->render('form/form', ['array' => $array]);

            }
        }
    }

}

?>