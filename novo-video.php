<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if ($url === false) {
    header('Location: /?success=0');
    exit();
}

$title = $_POST['titulo'];

$repository = new VideoRepository($pdo);

if ($repository->add(new Video($url, $title)) === false) {
    header('Location: /?success=0');

} else {
    header('Location: /?success=1');

}
