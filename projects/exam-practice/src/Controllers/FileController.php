<?php

namespace Controllers;

use Core\Pages;
use Requests\FileRequest;

class FileController
{

    public private(set) Pages $pages;


    public function __construct()
    {

        $this->pages = new Pages();
    }


    public function addFiles()
    {
        $data = $_POST['data'];
        $file = $_FILES['file'];

        $fileRequest = new FileRequest($data, $file);

        if(!empty($fileRequest->response['errors']))
            $this->pages->render('files/addFiles', $fileRequest->response);

        else
            $this->showFiles($fileRequest->fileList);
    }

    public function showFiles(array $files)  {
            $this->pages->render('files/showFiles', ['files' =>  $files ]);
    }
    
}