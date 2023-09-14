<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoRemoveController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {}
    
    public function processRequisition() : void  {
        $id = $_GET['id'];
          
        if ($this->videoRepository->removeVideo($id) === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
    
}

