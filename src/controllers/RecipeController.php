<?php

namespace Src\Controller;

require_once 'src/services/UserService.php';
require_once 'src/services/RecipeService.php';

use Src\Services\RecipeService;
use Src\Services\UserService;

class RecipeController{

    /**
     * Route: /recipe/summary/:id
     */
    public static function summaryAction($recipeId){
        $twig = \Templater::getInstance()->getTwig();

        $recipe = RecipeService::findById($recipeId);

        echo $twig->render(
            'recipe/recipe-resume-template.twig',
            [
                'recipe' => $recipe
            ]
        );
    }

    /**
     * Route: /recipe/validate/:id
     */
    public static function validateAction($recipeId){

        $recipe = RecipeService::findById($recipeId);

        $recipe->setValid(true);
        $recipe->setAdmin(UserService::findByEmail($_SESSION['email']));

        RecipeService::update($recipe);

        echo true;
    }
}
