<?php
namespace Src\Controllers;
require_once 'src/services/RecipeService.php';
require_once 'src/models/RecipeEntity.php';

use Src\Services\RecipeService;
use Src\Models\RecipeEntity;

class UserController{

		public static function indexAction(){
			require'bootstrap.php';
			echo $twig->render('user/user.html.twig', []);
		}

		public static function userRecipeAction() {
			require_once 'bootstrap.php';
			session_start();
			$recipes = RecipeService::fetchAllUserRecipe($_SESSION['email']);
			echo $twig->render('user/userRecipe.html.twig', ['recipes'=>$recipes]);

		}

		public static function userFavoriteAction() {
		    require_once 'bootstrap.php';
			echo $twig->render('user/userFavorite.html.twig', []);
		}

		public static function userAddRecipeAction() {
		require'bootstrap.php';
			echo $twig->render('user/userAddRecipe.html.twig', []);
			
		}

}