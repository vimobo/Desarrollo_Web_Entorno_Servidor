<?php
declare(strict_types=1);

namespace controller;

use lib\Pages;

class ContactosController {

    private Pages $pages;



	public function __construct(Pages $pages) {

		$this->pages = $pages;
	}

    

}