<?php

$dbPath = __DIR__ . '/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$video = [
    'VID_URL' => '',
    'VID_TITLE' => '',
];

if ($id !== false || $id !== null) {
    
    $stmt = $pdo->prepare("SELECT * FROM VID010 WHERE VID_ID = ?;");
    $stmt->bindValue(1, $id);
    $stmt->execute();

    $video = $stmt->fetch(PDO::FETCH_ASSOC);
}

?><?php require_once '_header.php';?>
    <main class="container">

        <form class="container__formulario" method="POST">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" value="<?= $video['VID_URL']; ?>" class="campo__escrita" required
                        placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" value="<?= $video['VID_TITLE']; ?>" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
                        id='titulo' />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>
<?php require_once '_footer.php';?>
