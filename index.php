<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router

require_once 'bootstrap.php';

include 'src/controllers/IndexController.php';
include 'src/controllers/LoginController.php';
include 'src/controllers/UserController.php';

use Src\Controllers\IndexController;
use Src\Controllers\LoginController;
use Src\Controllers\UserController;

$request = $_SERVER['REQUEST_URI'];

// When we need to fetch some parameters from the url, we need to use some Regular Expressions
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

// Routing
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

	case '/user':
		UserController::userRecipeAction();
		break;

	case '/user/recipe':
		UserController::userRecipeAction();
		break;

	case '/user/favorite':
		UserController::userFavoriteAction();
		break;

	case '/user/addrecipe':
		UserController::userAddRecipeAction();
		break;
    default:
        http_response_code(404);
        IndexController::pageNotFoundAction();
        break;
}

