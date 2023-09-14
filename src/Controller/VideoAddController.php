<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class VideoAddController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {}
    
    public function processRequisition() : void  {
        $url = $_POST['url'] = str_replace('watch?v=', 'embed/' ,$_POST['url']);
        $titulo = filter_input(INPUT_POST, 'titulo');
        
        if ($url === false || $titulo === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        
        if ($this->videoRepository->addVideo(new Video($url,$titulo)) === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}

