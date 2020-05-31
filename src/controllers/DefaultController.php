<?php

namespace src\controllers;

use src\services\AllergenService;
use src\services\RecipeService;
use src\services\SeasonService;
use src\services\TagService;
use src\services\TypeService;
use src\utils\Templater;

class DefaultController{

    public function home(){
        $recipes = RecipeService::findByValidation(true);
        $tags = TagService::fetchAll();
        $seasons = SeasonService::fetchAll();
        $types = TypeService::fetchAll();
        $allergens = AllergenService::fetchAll();

        echo Templater::getInstance()->getTwig()->render('home/home.html.twig',
            [
                'page' => 'accueil',
                'recipes' => $recipes, // Array of recipe entities,
                'filterTags' => $tags,
                'filterSeasons' => $seasons,
                'filterTypes' => $types,
                'filterAllergens' => $allergens
            ]
        );
    }

    public function pageNotFound(){
        echo Templater::getInstance()->getTwig()->render('layout/page-not-found.html.twig');
    }

    public function getType($type) 
    {
       
	}
}
