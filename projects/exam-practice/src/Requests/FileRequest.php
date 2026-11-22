<?php
declare(strict_types=1);

namespace Requests;

use Core\JsonInFile;
use Models\File;
use finfo;


class FileRequest
{

    public private(set) string $directory;
    public private(set) array $response;
    public private(set) File $file;
    public private(set) array $fileList;
    public private(set) string $fileOrigin;


    public function __construct($data, $file)
    {

        $this->response = $data ?? [];

        $this->fileOrigin = $file['tmp_name'];

        $this->directory = __DIR__ . "/../database";

        $this->fileList = [];

        $this->sanitizeData();
        $this->validateData();
        $this->validateFile($file);
    }

    public function sanitizeData(): void
    {
        $file = null;

        $this->response['fileName'] = htmlspecialchars(trim(strtolower($this->response['fileName'])));
        $this->response['description'] = htmlspecialchars(trim(strtolower($this->response['description'])));
        $this->response['author'] = htmlspecialchars(trim(strtolower($this->response['author'])));
        $this->response['category'] = htmlspecialchars(trim(strtolower($this->response['category'])));
    }

    public function validateData(): void
    {
        $response = $this->response;

        if (
            empty($response['fileName']) ||
            empty($response['description']) ||
            empty($response['author']) ||
            empty($response['category'])
        ) {
            $this->response['errors']['empty'] = "You need to fill all of the form";
        }

        if (
            !filter_var($response['fileName'], FILTER_VALIDATE_REGEXP, [
                'options' => ['regexp' => '/^[a-zA-Z0-9\s_-]+$/']
            ])
        ) {
            $this->response['errors']['empty'] = "Name must contain only letters and numbers";
        }

    }

    public function saveFile($extension)
    {
        $fileName = time() . "." . $extension;
        move_uploaded_file($this->fileOrigin, $this->directory . "/" . $fileName);
        $this->file->setFile($fileName);
    }

    public function saveFileJson(): void
    {
        $response = $this->response;
        var_dump($this->file);
        JsonInFile::addToJsonInFile($this->directory . "/files.json", $this->file->file, $this->file);

        $this->addFileList();
    }


    public function addFileList(): void
    {
        $this->fileList = JsonInFile::getDataFromJsonInFile($this->directory . "/files.json");
    }

    public function validateFile($input)
    {
        define('MAX_SIZE', 1024 * 1024 * 10);

        if ($input['name'] == '') {
            $this->response['errors']['empty'] = "Upload something..";
        }

        if ($input['error'] != UPLOAD_ERR_OK) {
            $this->response['errors']['size'] = "Upload has failed";
            return;
        }

        if (!is_uploaded_file($input['tmp_name'])) {
            $this->response['errors']['file'] = "Not a file";
        }

        if ($input['size'] > MAX_SIZE) {
            $this->response['errors']['size'] = "File size is above limit.";
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($this->fileOrigin);

        $extensions = [
            'application/zip' => 'zip',
            'application/pdf' => 'pdf',
            'image/jpeg' => 'jpg',
            'image/png' => 'png'
        ];

        $extension = $extensions[$mime] ?? null;

        if ($extension === null) {
            $this->response['errors']['extension'] = "File in not a zip, jpg, pdf or png";
        }

        if (empty($this->response['errors'])) {
            $this->file = new File($this->response['fileName'], $this->response['description'], $this->response['author'], $this->response['category']);
            $this->saveFile($extension);
            $this->saveFileJson();

        }


    }


}