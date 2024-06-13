<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$qry = "
    INSERT INTO
        VID010
            (VID_URL, VID_TITLE)
    VALUES
        (:url, :title);
";

$stmt = $pdo->prepare($qry);
$stmt->bindValue(':url', $_POST['url']);
$stmt->bindValue(':title', $_POST['titulo']);

if ($stmt->execute() === false) {
    header('Location: /index.php?success=0');

} else {
    header('Location: /index.php?success=1');

}
