<?php
declare(strict_types=1);

namespace Models;

use DirectoryIterator;

class Archive
{






	public function __construct()
	{
	}

	static function printImg(): array
	{

		$imgDirs = [];
		$iterator = new DirectoryIterator(__DIR__ . "/../../public/img");

		foreach ($iterator as $img) {

			if (is_file($img->getPathname()) && !$img->isDot()) {
				array_push($imgDirs, $img->getFilename());
			}

		}
		return $imgDirs;

	}
}