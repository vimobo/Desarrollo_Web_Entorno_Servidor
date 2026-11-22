<?php
declare(strict_types=1);

namespace Models;

class File {

    public private(set) string $fileName;
    public private(set) string $description;
    public private(set) string $author;
    public private(set) string $category;
    public private(set) string $file;


	public function __construct($fileName, $description, $author, $category) {

		$this->fileName = $fileName;
		$this->description = $description;
		$this->author = $author;
		$this->category = $category;
	}


	public function getFile() {
		return $this->file;
	}

	public function setFile($value) {
		$this->file = $value;
	}
}