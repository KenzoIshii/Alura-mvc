<?php
use Alura\Mvc\Controller\{VideoListController, VideoFormController, VideoAddController, VideoEditController, VideoRemoveController, Controller};

return [
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => VideoAddController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => VideoEditController::class,
    'GET|/remover-video' => VideoRemoveController::class,
    'GET|/' => VideoListController::class
];