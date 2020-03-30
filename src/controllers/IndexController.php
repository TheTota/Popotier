<?php

namespace Src\Controllers;

class IndexController{

    public static function indexAction(){
        require 'bootstrap.php';
        echo $twig->render('index/index.html.twig', ['page' => 'accueil']);
    }

    public static function pageNotFoundAction(){
        require 'bootstrap.php';
        echo $twig->render('layout/page-not-found.html.twig');
    }
}