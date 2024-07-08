<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoFormController extends ControllerHTML implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        /** @var ?video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        $this->renderTemplate(
            'video-form.php',
            ['video' => $video],
        );
    }
}
