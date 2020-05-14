<?php

namespace src\controllers;

use src\routing\RouterModule;
use src\utils\Templater;
use src\services\RecipeService;
use src\services\UserService;

class RecipeController
{
    /**
     * @param $recipeId
     * Route: /recipe/view/id
     * Name: view_recipe
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function view($recipeId)
    {
        $twig = Templater::getInstance()->getTwig();

        $recipe = RecipeService::findById($recipeId);

        echo $twig->render('recipe/recipe-view.html.twig', [
            'recipe' => $recipe
        ]);
    }

    public function addRecipe()
    {
        echo Templater::getInstance()->getTwig()->render('recipe/recipe-step-create.html.twig', []);
    }

    public function delete($recipeId) {
        RecipeService::deleteByID($recipeId);

        $path = RouterModule::getInstance()->generatePath('admin_recipes');
        header("location: $path");
    }

    /**
     * Route: /recipe/summary/:id
     */
    public function summary($recipeId)
    {
        $twig = Templater::getInstance()->getTwig();

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
    public function validate($recipeId)
    {

        $recipe = RecipeService::findById($recipeId);

        $recipe->setValid(true);
        $recipe->setAdmin(UserService::findByEmail($_SESSION['email']));

        if (RecipeService::update($recipe)) {
            echo true;
        } else {
            echo false;
        }
    }
}
