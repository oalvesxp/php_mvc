<?php

use Alura\Mvc\Controller\Error404Controller;
use Alura\Mvc\Repository\VideoRepository;


require_once __DIR__ . '/../vendor/autoload.php';

$path = __DIR__ . '/../database.sqlite';
$pdo = new PDO("sqlite:$path");
$repository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) { 
    $controllerClass = $routes[$key];

    /** @var Controller $controller */
    $controller = new $controllerClass($repository);
} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processRequest();
