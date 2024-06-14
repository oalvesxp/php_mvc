<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false){
    header("Location: ./index.php?success=0");
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if ($url === false) {
    header('Location: /index.php?success=0');
    exit();
}

$title = $_POST['titulo'];

$qry = "
    UPDATE VID010 SET VID_URL = :url, VID_TITLE = :title WHERE VID_ID = :id;
";

$stmt = $pdo->prepare($qry);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute() === false) {
    header('Location: /index.php?success=0');

} else {
    header('Location: /index.php?success=1');

}
