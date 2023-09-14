<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository
{

    public function __construct(private PDO $pdo)
    {
    }

    public function addVideo(Video $video) : bool
    {
        $sql = 'INSERT INTO videos (url, title) VALUES (:url, :titulo)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':titulo', $video->titulo);

        $result = $statement->execute();

        $video->setId($this->pdo->lastInsertId());
        return $result;
    }

    public function removeVideo(int $id) : bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);

        return $statement->execute();
    }

    public function updateVideo(Video $video) : bool
    {
        $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->titulo);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);
        
        $result = $statement->execute();
        return $result;
    }

    public function allVideos() : array{

        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrate(...),
            $videoList
        );
    }
    
    public function findVideo(int $id){
        $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        return $this->hydrate($statement->fetch(\PDO::FETCH_ASSOC));
    }
    
    private function hydrate(array $videoList) : Video {
        $video = new Video($videoList['url'], $videoList['title']);
        $video->setId($videoList['id']);
        
        return $video;
    }
}