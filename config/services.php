<?php

// Core
$container->bind(\App\Core\Router::class, function ($c) {
    return new \App\Core\Router($c, include(ROOT . '/config/routes.php'));
});
$container->bind(\App\Core\Controller::class, function ($c) {
    return new \App\Core\Controller($c);
});
$container->bind(\App\Core\View::class, function ($c) {
    return new \App\Core\View();
});

// Controller
$container->bind(\App\Controller\MessageController::class, function ($c) {
    return new \App\Controller\MessageController($c);
});

// Repository
$container->bind(\App\Repository\MessageRepository::class, function ($c) {
    return new \App\Repository\MessageRepository();
});

// Service
$container->bind(\App\Service\Pagination::class, function ($c) {
    return new \App\Service\Pagination();
});
$container->bind(\App\Service\Validator::class, function ($c) {
    return new \App\Service\Validator();
});