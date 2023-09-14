<?php
declare(strict_types=1);

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\{VideoListController, VideoFormController, VideoAddController, VideoEditController, VideoRemoveController, Controller};

require_once __DIR__.'/../vendor/autoload.php';
$path = $_SERVER['PATH_INFO'] ?? '/';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

switch($path){
    case '/novo-video':
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $controller = new VideoFormController($videoRepository);
            $controller->processRequisition();
        }
        else{
            $controller = new VideoAddController($videoRepository);
            $controller->processRequisition();
        }
    break;
    case '/editar-video':
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $controller = new VideoFormController($videoRepository);
            $controller->processRequisition();
        }
        else{
            $controller = new VideoEditController($videoRepository);
            $controller->processRequisition();
        }
    break;
    case '/remover-video':
        $controller = new VideoRemoveController($videoRepository);
        $controller->processRequisition();
    break;
    default:
        $controller = new VideoListController($videoRepository);
        $controller->processRequisition();
}
