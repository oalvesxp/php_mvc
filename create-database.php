<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$pdo->exec("
    CREATE TABLE VID010
        (
            VID_ID INTEGER PRIMARY KEY
            , VID_URL VARCHAR
            , VID_TITLE VARCHAR
        );
");
