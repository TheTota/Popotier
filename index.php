<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router
require_once 'bootstrap.php';

$request = $_SERVER['REQUEST_URI'];

$routerModule = RouterModule::getInstance();

try {
    $routerModule->checkURL($request);
} catch (Exception $e){
    $defaultController = new \Src\Controllers\DefaultController();
    $defaultController->pageNotFound();
}

