<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class VideoListJsonController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        $videoList = array_map(function (Video $video): array {
            return [
                'url' => $video->url,
                'title' => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilePath(),
            ];
        }, $this->repository->all());
        echo json_encode($videoList);

    }
}
