<?php
namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{    
    public function __construct(private VideoRepository $videoRepository)
    {}
    
    public function processRequisition() : void {
        $videoRepository = $this->videoRepository->allVideos();
        require_once __DIR__.'/../View/videoList.php';
    }
}

