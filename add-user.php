<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$email = $argv[1];
$passwd = $argv[2];
$hash = password_hash($passwd, PASSWORD_ARGON2ID); //PASSWORD_DEFAULT = BCRYPT

$qry = "INSERT INTO USR010 (USR_EMAIL, USR_PASSWD) VALUES ( ? , ? );";

$stmt = $pdo->prepare($qry);
$stmt->bindValue(1, $email);
$stmt->bindValue(2, $hash);
$stmt->execute();
