<?php
declare(strict_types=1);

use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__.'/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$path = $_SERVER['PATH_INFO'] ?? '/';
$request = $_SERVER['REQUEST_METHOD'];
$routes = require_once __DIR__.'/../config/routes.php';

$controllerClass = $routes["$request|$path"];
$controller = new $controllerClass($videoRepository);
$controller->processRequisition();