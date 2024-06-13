<?php 

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videos = $pdo->query("SELECT * FROM VID010;")->fetchAll(PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="./index.php"></a>

            <div class="cabecalho__icones">
                <a href="./pages/enviar-video.php" class="cabecalho__videos"></a>
                <a href="./pages/login.php" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videos as $video): ?>
            <?php if (str_starts_with($video['VID_URL'], 'http')): ?>
                <li class="videos__item">
                    <iframe width="100%" height="72%" src="<?= $video['VID_URL']; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <div class="descricao-video">
                        <img src="./img/logo.png" alt="logo canal alura">
                        <h3><?= $video['VID_TITLE']; ?></h3>
                        <div class="acoes-video">
                            <a href="./pages/enviar-video.php">Editar</a>
                            <a href="./remover-video.php?id=<?= $video['VID_ID']; ?>">Excluir</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</body>

</html>