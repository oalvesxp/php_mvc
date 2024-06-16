<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;
use PDOException;

class VideoRepository 
{
    public function __construct
    (
        private PDO $pdo
    ) {}

    /** @return bool - Cadastro de vídeos*/
    public function add(Video $video): bool
    {
        $qry = "
            INSERT INTO VID010 
                (VID_URL, VID_TITLE) 
            VALUES (:url, :title);
        ";

        $stmt = $this->pdo->prepare($qry);
        $stmt->bindValue(':url', $video->url);
        $stmt->bindValue(':title', $video->title);

        $this->pdo->beginTransaction();

        try{
            $stmt->execute();

            $id = $this->pdo->lastInsertId();
            $video->setId(intval($id));
            
            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();
            
            return false;
        }

    }

    /** @return bool - Remoção de vídeos*/
    public function remove(int $id): bool
    {
        $qry = "
            DELETE FROM VID010 WHERE VID_ID = :id;
        ";

        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($qry);
        $stmt->bindValue(':id', $id);
        
        try{
            $stmt->execute();

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();

            return false;
        }
    }

    /** @return bool - Atualização de vídeos*/
    public function update(Video $video): bool
    {
        $qry = "
            UPDATE VID010 
            SET VID_URL = :url, VID_TITLE = :title 
            WHERE VID_ID = :id;
        ";
        
        $stmt = $this->pdo->prepare($qry);
        $stmt->bindValue(':url', $video->url);
        $stmt->bindValue(':title', $video->title);
        $stmt->bindValue(':id', $video->id, PDO::PARAM_INT);

        $this->pdo->beginTransaction();
        
        try{
            $stmt->execute();

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();
           
            return false;
        }
    }

    /** @return Video[] */
    public function all(): array
    {
        $qry = "
            SELECT * FROM VID010;
        ";

         $videos = $this->pdo
            ->query($qry)
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            function (array $videoData) {
                $video = new Video(
                    $videoData['VID_URL'],
                    $videoData['VID_TITLE']
                );
                $video->setId($videoData['VID_ID']);

                return $video;
            }, $videos
        );
    }
}
