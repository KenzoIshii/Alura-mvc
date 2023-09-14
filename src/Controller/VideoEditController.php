<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class VideoEditController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {}
    public function processRequisition() : void  {
        $url = $_POST['url'] = str_replace('watch?v=', 'embed/' ,$_POST['url']);
        $titulo = filter_input(INPUT_POST, 'titulo');
        $id = filter_input(INPUT_GET, 'id');
        
        $video = new Video($url, $titulo);
        $video->setId($id);
        
        $result = $this->videoRepository->updateVideo($video);
        
        
        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
        
        
    }
    
}

