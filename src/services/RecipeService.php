<?php

namespace Src\Services;

require_once 'src/models/RecipeEntity.php';

require_once 'src/models/RecipeEntity.php';

require_once 'src/services/UserService.php';
require_once 'src/services/TypeService.php';
require_once 'src/services/IngredientService.php';
require_once 'src/services/StepService.php';

use Src\Models\RecipeEntity;
use Src\Models\RecipeTypeEntity;
use Src\Models\StepEntity;
use Src\Models\UserEntity;
use Src\Services\StepService;

class RecipeService
{

	private $db;

    public static function fetchAll()
    {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query('SELECT * FROM Recette');

        return self::createRecipeArray($recipes);
    }

    public static function findById($id): RecipeEntity
    {
        $db = DataBaseService::getInstance()->getDb();

        $recipe = $db->query("SELECT * FROM Recette WHERE id = '$id'")->fetch();

        return new RecipeEntity(
            $recipe['id'],
            $recipe['nom'],
            $recipe['image'],
            $recipe['date_creation'],
            $recipe['temps_cuisson'],
            $recipe['temps_preparation'],
            $recipe['nb_personnes'],
            $recipe['difficulte'],
            $recipe['prix_moyen'],
            $recipe['note_auteur'],
            $recipe['valide'],
            UserService::findByEmail($recipe['id_auteur']),
            TypeService::findById($recipe['id_type'])->getId(),
            ($recipe['id_admin'] == null) ? null : UserService::findByEmail($recipe['id_admin']),
            StepService::findByRecette($recipe['id']),
            null
        );
    }

    public static function update(RecipeEntity $recipe)
    {
        $db = DataBaseService::getInstance()->getDb();

        $statement = $db->prepare("UPDATE Recette SET 
            nom = ?,
            image = ?,
            temps_cuisson = ?, 
            temps_preparation = ?,
            nb_personnes = ?,
            difficulte = ?,
            prix_moyen = ?,
            note_auteur = ?,
            valide = ?,
            id_type = ?,
            id_admin = ?
            
            WHERE id = ?
        ");

        $response = $statement->execute([
            $recipe->getName(),
            $recipe->getImage(),
            $recipe->getCookingTime(),
            $recipe->getPreparationTime(),
            $recipe->getPersonNumber(),
            $recipe->getDifficulty(),
            $recipe->getMeanPrice(),
            $recipe->getAuthorQuote(),
            $recipe->getValid(),
            $recipe->getType()->getId(),	
            $recipe->getAdmin()->getEmail(),
            $recipe->getId()
        ]);

        if($response){
            return true;
        } else {
            return new \PDOException();
        }
    }

    public static function delete(RecipeEntity $id){
        $db = DataBaseService::getInstance()->getDb();
        $req = $db->exec("DELETE FROM Recette WHERE id=". $id );
    }

    public static function findAllThatNeedValidation(): array
    {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query('SELECT * FROM Recette WHERE valide = false');

        return self::createRecipeArray($recipes);
    }

    public static function add(RecipeEntity $recipe){
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
							id_auteur,
							valide,
							id_type
							) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $req->execute([
            $recipe->getName(),
            $recipe->getImage(),
            $recipe->getCookingTime(),
            $recipe->getPreparationTime(),
            $recipe->getPersonNumber(),
            $recipe->getDifficulty(),
			$recipe->getMeanPrice(),
            $recipe->getAuthorQuote(),
            $recipe->getAuthor()->getId(),
			$recipe->getValid(),
            $recipe->getType()->getId()
        ]);

    }

    public static function fetchAllUserFavoriteRecipe($userEmail){
        $db = DataBaseService::getInstance()->getDb();
        $recipes = $db->query("SELECT * FROM Recette JOIN Utilisateur_Recette on Recette.id = Utilisateur_Recette.id_recette AND Utilisateur_Recette.email ='" . $userEmail . "'");

        return self::createRecipeArray($recipes);
    }

    public static function fetchAllUserRecipe($userEmail){
        $db = DataBaseService::getInstance()->getDb();
        $recipes = $db->query("SELECT * FROM Recette WHERE id_auteur='" . $userEmail . "'");

        return self::createRecipeArray($recipes);
    }


    private static function createRecipeArray(\PDOStatement $recipes): array
    {
        $recipesArray = array();
        foreach ($recipes as $recipe) {
            array_push(
                $recipesArray,
                new RecipeEntity(
                    $recipe['id'],
                    $recipe['nom'],
                    $recipe['image'],
                    $recipe['date_creation'],
                    $recipe['temps_cuisson'],
                    $recipe['temps_preparation'],
                    $recipe['nb_personnes'],
                    $recipe['difficulte'],
                    $recipe['prix_moyen'],
                    $recipe['note_auteur'],
                    $recipe['valide'],
                    UserService::findByEmail($recipe['id_auteur']),
                    TypeService::findById($recipe['id_type']),
                    ($recipe['id_admin'] == null) ? null : UserService::findByEmail($recipe['id_admin']),
                    StepService::findByRecette($recipe['id']),
                    null
                )
            );
        }
        return $recipesArray;
    }
}