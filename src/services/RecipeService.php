<?php

namespace Src\Services;

use Src\Models\RecipeEntity;

class RecipeService{

	private $db;

    public static function fetchAll(){
		$db = DataBaseService::getInstance()->getDb();
		$recipes = $db->query("SELECT * FROM Recette")->fetchAll();
		return $recipes;
    }

    public function findById($id){
      	$db = DataBaseService::getInstance()->getDb();
		$recipe = $db->query("SELECT * FROM Recette WHERE ic='" . $id . "'")->fetch();
		return $recipe;
    }

    public function add(RecipeEntity $recipe){
        //TODO
    }

    public function update(RecipeEntity $recipe){
        //TODO
    }

    public function delete(RecipeEntity $id){
        //TODO
    }

	public static function fetchAllUserRecipe($userEmail){
		$db = DataBaseService::getInstance()->getDb();
		$recipes = $db->query("SELECT * FROM Recette WHERE email='" . $userEmail . "'")->fetchAll();
		return $recipes;
	}

}