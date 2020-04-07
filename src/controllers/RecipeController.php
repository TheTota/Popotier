<?php

namespace Src\Controllers;

require_once 'src/services/RecipeService.php';

use Src\Services\RecipeService;

class RecipeController{

	public static function addRecipeAction() {
		echo \Templater::getInstance()->getTwig()->render('recipe/recipe-step-create.html.twig', []);

	}

}