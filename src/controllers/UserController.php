<?php
namespace Src\Controllers;
require_once 'src/services/RecipeService.php';
require_once 'src/models/RecipeEntity.php';

use Src\Services\RecipeService;
use Src\Models\RecipeEntity;

class UserController{

		public static function indexAction(){
			echo \Templater::getInstance()->getTwig()->render('user/user.html.twig', []);
		}

		public static function userRecipeAction() {
			$recipes = RecipeService::fetchAllUserRecipe($_SESSION['email']);
			echo \Templater::getInstance()->getTwig()->render('user/userRecipe.html.twig', ['recipes'=>$recipes]);

		}

		public static function userFavoriteAction() {
			echo \Templater::getInstance()->getTwig()->render('user/userFavorite.html.twig', []);
		}

		public static function userAddRecipeAction() {
			echo \Templater::getInstance()->getTwig()->render('user/userAddRecipe.html.twig', []);
		}

}