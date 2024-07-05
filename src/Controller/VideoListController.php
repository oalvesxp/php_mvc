<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        session_start();
        if(!array_key_exists('login', $_SESSION)) {
            header('Location: /login');
            return;
        }

        $videos = $this->repository->all(); 
        require_once __DIR__ . '/../../views/video-list.php';
    }
}
