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

    public static function addRecipeAction() {
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
				null // steps
			);
			RecipeService::add($recipe);
			$recipeCreated = true;
			echo $twig->render('recipe/recipe-create.html.twig', ["recipeCreated"=> $recipeCreated]);
			return;
		}

	/*	if($recipeCreated)
		{
			header('Location: /user');
		} else {
			header('Location: /recipe/add');
		}

		*/
        echo $twig->render('recipe/recipe-step-create.html.twig', []);

    }

    public function delete($recipeId) {
        RecipeService::deleteByID($recipeId);
    }

    public function deleteValidatedRecipe($recipeId) {
        self::delete($recipeId);

        $path = RouterModule::getInstance()->generatePath(admin_validated_recipes);
        header("location: $path");
    }

    public function deleteRecipeToValidate($recipeId) {
        self::delete($recipeId);

        $path = RouterModule::getInstance()->generatePath(admin_recipes_to_validate);
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
}
