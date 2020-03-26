<?php
namespace Src\Controllers;
require_once 'src/services/RecipeService.php';
use Src\Services\RecipeService;

class UserController{

		public static function indexAction(){
			require'bootstrap.php';
			echo $twig->render('user/user.html.twig', []);
		}

		public static function userRecipeAction() {
			require_once 'bootstrap.php';
			session_start();

			//$recipes = RecipeService::fetchAllUserRecipe($_SESSION['email']);
			
			$recipes = ['Tarte aux pommes', 'tarte aux citrons'];

			echo $twig->render('user/userRecipe.html.twig', ['recipes'=>$recipes]);
		}

		public static function userFavoriteAction() {
		    require_once 'bootstrap.php';
			echo $twig->render('user/userFavorite.html.twig', []);
		}

}