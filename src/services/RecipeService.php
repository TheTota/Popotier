<?php

namespace Src\Services;

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

class RecipeService{


    public static function fetchAll() {
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query('SELECT * FROM Recette');

        return self::createRecipeArray($recipes);
    }

    public static function findById($id){
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
            $recipe['note_recette'],
            $recipe['note_auteur'],
            $recipe['valide'],
            UserService::findByEmail($recipe['id_auteur']),
            TypeService::findById($recipe['id_type']),
            ($recipe['id_admin'] == null) ? null : UserService::findByEmail($recipe['id_admin']),
            StepService::findByRecette($recipe['id'])
        );
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

    public static function findAllThatNeedValidation(): array{
        $db = DataBaseService::getInstance()->getDb();

        $recipes = $db->query('SELECT * FROM Recette WHERE valide = false');

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
                    $recipe['note_recette'],
                    $recipe['note_auteur'],
                    $recipe['valide'],
                    UserService::findByEmail($recipe['id_auteur']),
                    TypeService::findById($recipe['id_type']),
                    ($recipe['id_admin'] == null) ? null : UserService::findByEmail($recipe['id_admin']),
                    StepService::findByRecette($recipe['id'])
                )
            );
        }
        return $recipesArray;
    }

}