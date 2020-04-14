<?php

namespace Src\Controllers;

use Src\Utils\Templater;
use Src\Services\RecipeService;
use Src\Services\UserService;
use Src\Services\RecipeTypeService;
use Src\Models\RecipeEntity;


class RecipeController {


    public static function add() {
	    $twig = Templater::getInstance()->getTwig();
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

    /**
     * Route: /recipe/summary/:id
     */
    public function summary($recipeId) {
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
    public function validate($recipeId){

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
