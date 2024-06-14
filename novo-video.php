<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if ($url === false) {
    header('Location: /?success=0');
    exit();
}

$title = $_POST['titulo'];

$qry = "
    INSERT INTO VID010 (VID_URL, VID_TITLE) VALUES (:url, :title);
";

$stmt = $pdo->prepare($qry);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);

if ($stmt->execute() === false) {
    header('Location: /?success=0');

} else {
    header('Location: /?success=1');

}
