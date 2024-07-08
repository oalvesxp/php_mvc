<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {}

    public function processRequest(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            $_SESSION['error_message'] = 'URL inválida';
            header('Location: /novo-video');
            return;
        }

        $title = filter_input(INPUT_POST, 'titulo');
        if ($title === false) {
            $_SESSION['error_message'] = 'Título não informado';
            header('Location: /novo-video');
            return;
        }

        $video = new Video($url, $title);
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

        $success = $this->repository->add($video);
        if ($success === false) {
            $_SESSION['error_message'] = 'Erro ao cadastrar vídeo';
            header('Location: /novo-video');
            return;
        } else {
            header('Location: /?success=1');
        }
    }
}
