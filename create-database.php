<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

/** Tabela de videos */
/**$pdo->exec("
    CREATE TABLE VID010
        (
            VID_ID INTEGER PRIMARY KEY
            , VID_URL VARCHAR
            , VID_TITLE VARCHAR
        );
");*/

/**$pdo->exec("
    CREATE TABLE USR010
        (
            USR_ID INTEGER PRIMARY KEY
            , USR_EMAIL VARCHAR
            , USR_PASSWD VARCHAR
        );
");*/

$pdo->exec("
    ALTER TABLE VID010
    ADD COLUMN
        VID_IMGPATH VARCHAR;
");
