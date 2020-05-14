<?php

namespace src\controllers;

use src\services\RecipeService;
use src\utils\Templater;

class DefaultController{

    public function home(){
        $recipes = RecipeService::findByValidation(true);

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
