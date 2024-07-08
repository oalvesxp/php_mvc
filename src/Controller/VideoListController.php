<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController extends ControllerHTML implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        $videos = $this->repository->all();
        echo $this->renderTemplate(
            'video-list.php',
            ['videos' => $videos],
        );
    }
}
