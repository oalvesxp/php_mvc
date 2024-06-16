<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null){
    header("Location: ./index.php?success=0");
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if ($url === false) {
    header('Location: /index.php?success=0');
    exit();
}

$title = $_POST['titulo'];

$video = new Video($url, $title);
$video->setId($id);

$repository = new VideoRepository($pdo);

if ($repository->update($video) === false) {
    header('Location: /?success=0');

} else {
    header('Location: /?success=1');

}
