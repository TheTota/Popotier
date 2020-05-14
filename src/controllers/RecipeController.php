<?php

namespace src\controllers;

use src\utils\Templater;
use src\services\RecipeService;
use src\services\UserService;
use Src\Services\RecipeTypeService;
use Src\Models\RecipeEntity;
use Src\Models\StepEntity;

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

    public static function add() {
	    $twig = Templater::getInstance()->getTwig();
		$recipeCreated = false;

		if (!empty($_POST)) {

            $steps = array();

            for($i = 0; $i < count($_POST['stepList']); $i++) {
                array_push( 
                    $steps,
                    new StepEntity(
                        null,
                        $i+1,
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
			if(RecipeService::add($recipe)) {
            	$recipeCreated = true;
            }
			echo $twig->render('recipe/recipe-create.html.twig', ["recipeCreated"=> $recipeCreated]);
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
}
