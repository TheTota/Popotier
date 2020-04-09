<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router

require_once 'bootstrap.php';
require_once 'src/controllers/IndexController.php';
require_once 'src/controllers/LoginController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/controllers/AdminController.php';
require_once 'src/controllers/RecipeController.php';


use Src\Controllers\IndexController;
use Src\Controllers\LoginController;
use Src\Controller\AdminController;
use Src\Controller\RecipeController;

$request = $_SERVER['REQUEST_URI'];

// When we need to fetch some parameters from the url, we need to use some Regular Expressions

// For /user/verify/alias/:alias
if( preg_match('/^(\/user\/verify\/alias\/)[a-zA-Z]+/', $request)){
    $splitRequest = explode('/', $request);
    $alias = $splitRequest[4];
    $request = '/user/verify/alias';
}

// For /user/verify/email/:email
if( preg_match('/^(\/user\/verify\/email\/)[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/', $request)){
    $splitRequest = explode('/', $request);
    $email = $splitRequest[4];
    $request = '/user/verify/email';
}

// For /recipe/summary/:id
if( preg_match('/^(\/recipe\/summary\/)[0-9]+/', $request)){
    $splitRequest = explode('/', $request);
    $recipeId = $splitRequest[3];
    $request = '/recipe/summary/:id';
}

// For /recipe/validate/:id
if( preg_match('/^(\/recipe\/validate\/)[0-9]+/', $request)){
    $splitRequest = explode('/', $request);
    $recipeId = $splitRequest[3];
    $request = '/recipe/validate/:id';
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

    case '/admin/view/dashboard':
        adminGuard();
        AdminController::viewAction();
        break;

    case '/admin/view/recipes':
        AdminController::viewRecipesAction();
        break;

    case '/recipe/summary/:id':
        RecipeController::summaryAction($recipeId);
        break;

    case '/recipe/validate/:id':
        RecipeController::validateAction($recipeId);
        break;

    default:
        http_response_code(404);
        IndexController::pageNotFoundAction();
        break;
}

function adminGuard() {
    if($_SESSION['role'] != 'admin'){
        header('location: /home');
    }
}

