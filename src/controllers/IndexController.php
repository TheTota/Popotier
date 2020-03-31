<?php

namespace Src\Controllers;

class IndexController{

    public static function indexAction(){

        echo \Templater::getInstance()->getTwig()->render('index/index.html.twig', ['page' => 'accueil']);
    }

    public static function pageNotFoundAction(){
        require 'bootstrap.php';
        echo \Templater::getInstance()->getTwig()->render('layout/page-not-found.html.twig');
    }
}