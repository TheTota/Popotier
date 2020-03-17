<?php


$request = $_SERVER['REQUEST_URI'];
var_dump($request);

switch ($request) {
    case '/popotier/' :
        require_once 'src/controllers/IndexController.php';
        IndexController::indexAction();
        break;
    case '/popotier/login':
        require_once 'src/controllers/LoginController.php';
        LoginController::indexAction();
        break;
    case '/about':
        require __DIR__ . '/views/about.php';
        break;

    default:
        http_response_code(404);
        require_once 'src/controllers/IndexController.php';
        IndexController::pageNotFoundAction();
        break;
}

//echo $twig->render('index/index.html.twig', ['page' => 'accueil']);
