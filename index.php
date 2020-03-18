<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router
include 'src/controllers/IndexController.php';
include 'src/controllers/LoginController.php';

use Src\Controllers\IndexController;
use Src\Controllers\LoginController;

$request = $_SERVER['REQUEST_URI'];
var_dump($request);

// For test purpose
if( preg_match('/^(\/popotier\/recette\/)[0-9]+/', $request)){
    $splitRequest = explode('/', $request);
    var_dump($splitRequest);die;
}

switch ($request) {
    case '/' :
        header('Location: /home');
        break;

    case '/home':
        IndexController::indexAction();
        break;

    case '/login':
        LoginController::indexAction();
        break;

    default:
        http_response_code(404);
        IndexController::pageNotFoundAction();
        break;
}

