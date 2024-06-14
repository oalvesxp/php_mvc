<?php require_once '_header.php'; ?>
    <style>
    .titulo {
        color: var(--azul-medio);
        font-weight: regular;
        font-size: 32px;
    }
    </style>

    <main class="container">
        <h1 class="titulo">Desculpe... A página 
            <span style="font-weight: bold;"><?= $_SERVER['PATH_INFO']?> </span> 
            não foi encontrada.
        </h1>
    </main>
<?php require_once '_footer.php'; ?>
