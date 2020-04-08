<?php

namespace Src\Services;

require_once 'src/models/RecipeEntity.php';

require_once 'src/models/RecipeEntity.php';

require_once 'src/services/UserService.php';
require_once 'src/services/TypeService.php';
require_once 'src/services/IngredientService.php';

use Src\Models\RecipeEntity;
use Src\Models\RecipeTypeEntity;
use Src\Models\UserEntity;

class RecipeService{

	private $db;

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
                    UserService::findByEmail($recipe['id_auteur']),
                    TypeService::findById($recipe['id_type']),
                    null
                )
            );
        }

        return $recipesArray;
    }

    public function findById($id){
      	$db = DataBaseService::getInstance()->getDb();
		$req = $db->query("SELECT * FROM Recette WHERE id='" . $id . "'")->fetch();

		$recipe = new RecipeEntity(
					$req['id'],
                    $req['nom'],
                    $req['image'],
                    $req['temps_cuisson'],
                    $req['temps_preparation'],
                    $req['nb_personnes'],
                    $req['difficulte'],
                    $req['prix_moyen'],
                    $req['note_recette'],
                    $req['note_auteur'],
                    $req['valid'],
                    $req['id_auteur'],
                    $req['id_type'],
                    null
					);
		return $recipe;
    }

    public function add(RecipeEntity $recipe){
        $db = DataBaseService::getInstance()->getDb();
		$req = $db->prepare("INSERT INTO Recette (
							nom,
							image,
							temps_cuisson,
							temps_preparation,
							nb_personnes,
							difficulte,
							prix_moyen,
							note_auteur, 
							valid,
							id_auteur, 
							id_type
							) VALUES(?,?,?,?,?,?,?,?,?,?);");

		$req->execute([
			$recipe->getName(),
			$recipe->getImage(),
			$recipe->getCookingTime(),
			$recipe->getPreparationTime(),
			$recipe->getPersonNumber(),
			$recipe->getDifficulty(),
			$recipe->getMeanPrice(),
			$recipe->getAuthorQuote(),
			$recipe->getValid(),
			$recipe->getAuthor(),
			$recipe->getType()		
		]);
    }

    public function update(RecipeEntity $recipe){
	   $db = DataBaseService::getInstance()->getDb();
       $req = "UPDATE Recette SET 
							nom=?,
							image=?,
							temps_cuisson=?,
							temps_preparation=?,
							nb_personnes=?,
							difficulte=?,
							prix_moyen=?,
							note_auteur=?, 
							valid=?,
							id_auteur=?, 
							id_type=?, 
							valid=?,
							id_admin=? 
							WHERE id=?";
		$db->prepare($req)->execute([
			$recipe->getName(),
			$recipe->getImage(),
			$recipe->getCookingTime(),
			$recipe->getPreparationTime(),
			$recipe->getPersonNumber(),
			$recipe->getDifficulty(),
			$recipe->getMeanPrice(),
			$recipe->getAuthorQuote(),
			$recipe->getValid(),
			$recipe->getAuthor(),
			$recipe->getType(),
			$recipe->getValid(),
			$recipe->getAdmin(),
			$recupe->getId()
		]);
    }

    public function delete(RecipeEntity $id){
       $db = DataBaseService::getInstance()->getDb();
	   $req = $db->exec("DELETE FROM Recette WHERE id=". $id );
    }

	public static function fetchAllUserRecipe($userEmail){
		$db = DataBaseService::getInstance()->getDb();
		$req = $db->query("SELECT * FROM Recette WHERE id_auteur='" . $userEmail . "'")->fetchAll();
		$recipes = array();

		foreach($req as $row){
			array_push($recipes,
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
                    $row['valide'],
                    UserService::findByEmail($row['id_auteur']),
                    TypeService::findById($row['id_type']),
                    null
				)
			);
		}

		return $recipes;
	}

	public static function fetchAllUserFavoriteRecipe($userEmail){
		$db = DataBaseService::getInstance()->getDb();
		$req = $db->query("SELECT * FROM Recette JOIN Utilisateur_Recette on Recette.id = Utilisateur_Recette.id_recette AND Utilisateur_Recette.email ='" . $userEmail . "'")->fetchAll();

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
					$row['valide'],
					$row['id_auteur'],
					$row['id_type'],
					null
			);
			array_push($recipes, $recipe);
		}
		return $recipes;
	}
}