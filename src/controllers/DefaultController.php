<?php

namespace Src\Controllers;

use Src\Services\RecipeService;
use Src\Utils\Templater;

class DefaultController{

    public function home(){
        $recipes = RecipeService::fetchAll();

        echo Templater::getInstance()->getTwig()->render('home/home.html.twig',
            [
                'page' => 'accueil',
                'recipes' => $recipes // Array of recipe entities
            ]
        );
    }

    public function pageNotFound(){
        echo Templater::getInstance()->getTwig()->render('layout/page-not-found.html.twig');
    }
}
