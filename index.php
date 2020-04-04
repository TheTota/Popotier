<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router

require_once 'bootstrap.php';

require_once 'src/controllers/IndexController.php';
require_once 'src/controllers/LoginController.php';
require_once 'src/controllers/UserController.php';

use Src\Controllers\IndexController;
use Src\Controllers\LoginController;

$request = $_SERVER['REQUEST_URI'];

// For test purpose
if( preg_match('/^(\/recette\/)[0-9]+/', $request)){
    $splitRequest = explode('/', $request);
    var_dump($splitRequest[2]);die;
}

if( preg_match('/^(\/user\/verify\/alias\/)[a-zA-Z]+/', $request)){
    $splitRequest = explode('/', $request);
    $alias = $splitRequest[4];
    $request = '/user/verify/alias';
}

if( preg_match('/^(\/user\/verify\/email\/)[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/', $request)){
    $splitRequest = explode('/', $request);
    $email = $splitRequest[4];
    $request = '/user/verify/email';
}

switch ($request) {
    case '/' :
        header('Location: /home');
        break;

    case '/home':
        IndexController::homeAction();
        break;

    case '/login':
        LoginController::loginAction();
        break;

    case '/logout':
        LoginController::logoutAction();
        break;

    case '/user/add':
        UserController::addAction();
        break;

    case '/user/verify/alias':
        UserController::aliasVerify($alias);
        break;

    case '/user/verify/email':
        UserController::emailVerify($email);
        break;

    default:
        http_response_code(404);
        IndexController::pageNotFoundAction();
        break;
}

