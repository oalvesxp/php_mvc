<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        $videos = $this->repository->all(); 
        require_once __DIR__ . '/../../_header.php';
        
        ?>
            <ul class="videos__container" alt="videos alura">
                <?php foreach ($videos as $video): ?>
                    <?php if (str_starts_with($video->url, 'http')): ?>
                        <li class="videos__item">
                            <iframe width="100%" height="72%" src="<?= $video->url; ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            <div class="descricao-video">
                                <img src="./img/logo.png" alt="logo canal alura">
                                <h3><?= $video->title; ?></h3>
                                <div class="acoes-video">
                                    <a href="/editar-video?id=<?= $video->id; ?>">Editar</a>
                                    <a href="/remover-video?id=<?= $video->id; ?>">Excluir</a>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php require_once __DIR__ . '/../../_footer.php';
    }
}
