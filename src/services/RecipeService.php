<?php

namespace Src\Services;
require_once 'src/models/RecipeEntity.php';

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
		$req = $db->query("SELECT * FROM Recette WHERE email='" . $userEmail . "'")->fetchAll();
		$recipes = array();

		foreach($req as $row){
			$recipe = new RecipeEntity(
				$row['id'], 
				$row['nom'],
				$row['image'],
				$row['temps_cuisson'],
				$row['temps_preparation'],
				$row['nb_personnes'],
				$row['difficulte'],
				$row['prix_moyen'],
				$row['note_recette'],
				$row['note_auteur'],
				$row['id_type']
			);
			array_push($recipes, $recipe);
		}
		return $recipes;
	}


}