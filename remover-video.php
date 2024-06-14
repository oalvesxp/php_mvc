<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = $_GET['id'];

$qry = "
    DELETE FROM VID010 WHERE VID_ID = :id;
";

$stmt = $pdo->prepare($qry);
$stmt->bindValue(':id', $id);

if ($stmt->execute() === false) {
    header('Location: /?success=0');

} else {
    header('Location: /?success=1');

}
