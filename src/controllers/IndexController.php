<?php

namespace Src\Controllers;

require_once 'src/services/RecipeService.php';

use Src\Services\RecipeService;

class IndexController{

    public static function homeAction(){
        $recipes = RecipeService::fetchAll();

        echo \Templater::getInstance()->getTwig()->render('home/home.html.twig',
            [
                'page' => 'accueil',
                'recipes' => $recipes // Array of recipe entities
            ]
        );
    }

    public static function pageNotFoundAction(){
        require 'bootstrap.php';
        echo \Templater::getInstance()->getTwig()->render('layout/page-not-found.html.twig');
    }
}