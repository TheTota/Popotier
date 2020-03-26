<?php

namespace Src\Services;

require_once 'src/models/RecipeEntity.php';

require_once 'src/services/UserService.php';
require_once 'src/services/TypeService.php';
require_once 'src/services/IngredientService.php';

use Src\Models\RecipeEntity;
use Src\Models\RecipeTypeEntity;
use Src\Models\UserEntity;

class RecipeService{


    public static function fetchAll() {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query('SELECT * FROM Recette');

        $recipesArray =  array();
        foreach ($recipes as $recipe) {
            // TODO: fetch author, type and ingredients and create the entity before creating the recipe entity

            array_push(
                $recipesArray,
                new RecipeEntity(
                    $recipe['id'],
                    $recipe['nom'],
                    $recipe['image'],
                    $recipe['temps_cuisson'],
                    $recipe['temps_preparation'],
                    $recipe['nb_personnes'],
                    $recipe['difficulte'],
                    $recipe['prix_moyen'],
                    $recipe['note_recette'],
                    $recipe['note_auteur'],
                    true,
                    UserService::findByEmail($recipe['email']),
                    TypeService::findById($recipe['id_type']),
                    null
                )
            );
        }

        return $recipesArray;
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