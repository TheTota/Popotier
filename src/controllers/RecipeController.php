<?php

namespace Src\Controller;


use Src\Services\RecipeService;

class RecipeController{

    // Route: recipe/view/:id
    public static function viewAction($recipe){
        $twig = \Templater::getInstance()->getTwig();

        $recipe = RecipeService::findById($recipe);

        echo $twig->render(
            'recipe/recipe-resume-template.twig',
            [
                'recipe' => $recipe
            ]
        );
    }
}