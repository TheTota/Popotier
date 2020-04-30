<?php

// An htaccess file has been configured to redirect all request to this file
// This file will be our router
require_once 'bootstrap.php';

use src\routing\RouterModule;
use src\services\MailerService;


$request = $_SERVER['REQUEST_URI'];

$routerModule = RouterModule::getInstance();

try {
    $routerModule->checkURL($request);
} catch (Exception $e){
    $defaultController = new \src\controllers\DefaultController();
    $defaultController->pageNotFound();
}

