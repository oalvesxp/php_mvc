<?php

use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller, 
    NewVideoController, 
    VideoFormController, 
    VideoListController
};
use Alura\Mvc\Repository\VideoRepository;


require_once __DIR__ . '/../vendor/autoload.php';

$path = __DIR__ . '/../database.sqlite';
$pdo = new PDO("sqlite:$path");
$repository = new VideoRepository($pdo);


if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    $controller = new VideoListController($repository);

}  elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($repository);
        
    } elseif  ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new NewVideoController($repository);

    }

} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new VideoFormController($repository);
        
    } elseif  ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new EditVideoController($repository);

    }

} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    $controller = new DeleteVideoController($repository);
} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processRequest();
