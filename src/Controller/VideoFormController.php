<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class VideoFormController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {}
    
    public function processRequisition() : void  {
     
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if(isset($id)){
            $video = $this->videoRepository->findVideo($id);
        }
        require_once __DIR__.'/../View/videoForm.php';
    }
}