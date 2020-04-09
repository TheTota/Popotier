<?php


namespace Src\Controllers;

require_once 'src/services/UserService.php';
require_once 'src/services/RecipeService.php';

use Src\Services\RecipeService;
use Src\Services\UserService;

class RecipeController {


    public static function addRecipeAction() {
        echo \Templater::getInstance()->getTwig()->render('recipe/recipe-step-create.html.twig', []);

    }

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

        if(RecipeService::update($recipe)){
            echo true;
        } else {
            echo false;
        }
    }
}
