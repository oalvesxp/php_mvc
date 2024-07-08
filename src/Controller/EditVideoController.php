<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /?success=0');
            return;
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?success=0');
            return;
        }

        $title = filter_input(INPUT_POST, 'titulo');
        if ($title === false) {
            header('Location: /?success=0');
            return;
        }

        $video = New Video($url, $title);
        $video->setId($id);
        
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK){
            
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);

            if(\str_starts_with($mimeType, 'image/')) {
                $safeFileName = uniqid('upload_') . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);

                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/'. $safeFileName 
                );
                $video->setFilePath($safeFileName);
            }
        }

        $success = $this->repository->update($video);

        if ($success === false) {
            header('Location: /?success=0');
        } else {
            header('Location: /?success=1');
        }
    }
}
