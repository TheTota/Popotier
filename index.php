<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router
require_once 'bootstrap.php';

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/LoginController.php';
require_once 'src/controllers/AdminController.php';
require_once 'src/controllers/RecipeController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/routing/Route.php';

use Src\Controllers\DefaultController;
use Src\Controllers\LoginController;
use Src\Controllers\AdminController;
use Src\Controllers\RecipeController;
use Src\Controllers\UserController;



$request = $_SERVER['REQUEST_URI'];

$routerModule = RouterModule::getInstance();

$routerModule

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
        $defaultController = new DefaultController();
        $defaultController->home();
        break;

    case '/login':
        $loginController = new LoginController();
        $loginController->login();
        break;

    case '/logout':
        $loginController = new LoginController();
        $loginController->logout();
        break;

    case '/user/add':
        $userController = new UserController();
        $userController->add();
        break;

    case '/user/verify/alias':
        $userController = new UserController();
        $userController->aliasVerify($alias);
        break;

    case '/user/verify/email':
        $userController = new UserController();
        $userController->emailVerify($email);
        break;

	case '/user/view/recipe-list':
        $userController = new UserController();
		$userController->viewRecipe();
		break;

	case '/user/view/favorite-list':
        $userController = new UserController();
		$userController->viewFavorite();
		break;

	case '/recipe/add':
	    $recipeController = new RecipeController();
		$recipeController->addRecipe();
		break;

    case '/admin/view/dashboard':
        adminGuard();
        $adminController = new AdminController();
        $adminController->view();
        break;

    case '/admin/view/recipes':
        $adminController = new AdminController();
        $adminController->viewRecipes();
        break;

    case '/recipe/summary/:id':
        $recipeController = new RecipeController();
        $recipeController->summary($recipeId);
        break;

    case '/recipe/validate/:id':
        $recipeController = new RecipeController();
        $recipeController->validate($recipeId);
        break;

    default:
        http_response_code(404);
        $defaultController = new DefaultController();
        $defaultController->pageNotFound();
        break;
}

function adminGuard() {
    if($_SESSION['role'] != 'admin'){
        header('location: /home');
    }
}

