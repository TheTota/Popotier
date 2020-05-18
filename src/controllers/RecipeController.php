<?php

namespace src\controllers;

use src\routing\RouterModule;
use src\utils\Templater;
use src\services\RecipeService;
use src\services\UserService;
use Src\Services\RecipeTypeService;
use src\models\RecipeEntity;
use src\models\StepEntity;

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
        // if connected, check if the recipe is liked by user
        $recipeLikedByUser = false;
        if (isset($_SESSION['email'])) {
            $recipeLikedByUser = RecipeService::recipeIsLiked($_SESSION['id'], $recipeId);
        }

        echo $twig->render('recipe/recipe-view.html.twig', [
            'recipe' => $recipe,
            'recipeLiked' => $recipeLikedByUser
        ]);
    }

    public static function add()
    {
        $twig = Templater::getInstance()->getTwig();
        $recipeCreated = false;

        if (!empty($_POST)) {
            $steps = array();

            for ($i = 0; $i < count($_POST['stepList']); $i++) {
                array_push(
                    $steps,
                    new StepEntity(
                        null,
                        $i + 1,
                        $_POST['stepList'][$i]
                    )
                );
            }

            $recipe = new RecipeEntity(
                null, // id
                $_POST['inputName'],
                $_POST['inputImage'],
                null, //date creation
                $_POST['inputCookingTime'],
                $_POST['inputPreparationTime'],
                $_POST['inputPersonNumber'],
                $_POST['inputDifficulty'],
                $_POST['inputMeanPrice'],
                $_POST['inputAuthorQuote'],
                0, //valid
                UserService::findByEmail($_SESSION['email']),
                RecipeTypeService::findById($_POST['inputType']),
                null, // admin
                $steps, // steps
                null //ingredients
            );
            if (RecipeService::add($recipe)) {
                $recipeCreated = true;
            }
            echo $twig->render('recipe/recipe-create.html.twig', ["recipeCreated" => $recipeCreated]);
            return;
        }

        echo $twig->render('recipe/recipe-step-create.html.twig', []);
    }

    public function delete($recipeId) {
        RecipeService::deleteByID($recipeId);
    }

    public static function addRecipeAction()
    {
        $twig = \Templater::getInstance()->getTwig();
        $recipeCreated = false;

        if (!empty($_POST)) {

            $recipe = new RecipeEntity(
                null, // id
                $_POST['inputName'],
                $_POST['inputImage'],
                null, //date creation
                $_POST['inputCookingTime'],
                $_POST['inputPreparationTime'],
                $_POST['inputPersonNumber'],
                $_POST['inputDifficulty'],
                $_POST['inputMeanPrice'],
                null, //evaluation
                $_POST['inputAuthorQuote'],
                0, //valid
                UserService::findByEmail($_SESSION['email']),
                RecipeTypeService::findById($_POST['inputType']),
                null, // admin
                null, // steps
                null //ingredients
            );
            if (RecipeService::add($recipe)) {
                $recipeCreated = true;
            }
            echo $twig->render('recipe/recipe-create.html.twig', ["recipeCreated" => $recipeCreated]);
            return;
        }

        echo $twig->render('recipe/recipe-step-create.html.twig', []);
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

    /**
     * Route: /recipe/validate/:id
     */
    public function devalidate($recipeId)
    {
        $recipe = RecipeService::findById($recipeId);

        $recipe->setValid(false);
        $recipe->setAdmin(UserService::findByEmail($_SESSION['email']));

        if (RecipeService::update($recipe)) {
            echo true;
        } else {
            echo false;
        }
    }

    /**
     * Route: /recipe/like/:id
     */
    public function like($recipeId) {
        // if connected, like the recipe
        if (isset($_SESSION['email'])) {
            $userId = $_SESSION['id'];
            if (RecipeService::recipeIsLiked($userId, $recipeId)) {
                RecipeService::dislikeRecipe($userId, $recipeId);
            } else {
                RecipeService::likeRecipe($userId, $recipeId);
            }
        } else { // not connected, redirect towards login page
            header('location: /login');
        }
    }

    public function searchByString($normalizedSearchString){
        $twig = Templater::getInstance()->getTwig();

        $recipes = RecipeService::searchByName($normalizedSearchString);

        echo $twig->render("recipe/components/file-list-component.html.twig", [ "recipes" => $recipes]);
    }
}
