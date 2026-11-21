<?php

declare(strict_types=1);


use Core\Router;
use Controllers\AuthController;

Router::add("get", "/", [AuthController::class, 'showHome']);
Router::add("get", "/login", [AuthController::class, 'login']);
Router::add("post", "/processLogin", [AuthController::class, 'processLogin']);
Router::add("get", "/register", [AuthController::class, 'register']);
Router::add("post", "/processRegister", [AuthController::class, 'processRegister']);
Router::add("post", "/addFiles", [AuthController::class, 'renderAddFiles']);
