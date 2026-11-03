<?php
declare(strict_types=1);

use Controller\FrontController;

require_once __DIR__ . '/../autoloader.php';
require_once __DIR__ . '/../config/config.php';

Controller\FrontController::main();
?>