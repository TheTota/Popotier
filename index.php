<?php
// An htaccess file has been configured to redirect all request to this file
// This file will be our router

$request = $_SERVER['REQUEST_URI'];
var_dump($request);

// For test purpose
if( preg_match('/^(\/popotier\/recette\/)[0-9]+/', $request)){
    $splitRequest = explode('/', $request);
    var_dump($splitRequest);die;
}

switch ($request) {
    case '/popotier/' :
        require_once 'src/controllers/IndexController.php';
        IndexController::indexAction();
        break;

    case '/popotier/home':
        require_once 'src/controllers/IndexController.php';
        IndexController::indexAction();
        break;

    case '/popotier/login':
        require_once 'src/controllers/LoginController.php';
        LoginController::indexAction();
        break;

    default:
        http_response_code(404);
        require_once 'src/controllers/IndexController.php';
        IndexController::pageNotFoundAction();
        break;
}

