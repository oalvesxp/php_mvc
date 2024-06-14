<?php 

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videos = $pdo->query("SELECT * FROM VID010;")->fetchAll(PDO::FETCH_ASSOC);

?><?php require_once '_header.php';?>
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
                            <a href="/editar-video?id=<?= $video['VID_ID']; ?>">Editar</a>
                            <a href="/remover-video?id=<?= $video['VID_ID']; ?>">Excluir</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php require_once '_footer.php';?>
