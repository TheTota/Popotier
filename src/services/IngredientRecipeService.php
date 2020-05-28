<?php

namespace src\services;

use src\models\IngredientEntity;
use src\models\IngredientRecipeEntity;

class IngredientRecipeService {

    public static function findAllByRecipe($recipeId)
    {
        $db = DataBaseService::getInstance()->getDb();

        $ingredients = $db->query("SELECT * FROM Ingredient_Recette WHERE id_recette = '$recipeId'");


        $ingredientArray = [];

        foreach ($ingredients as $ingredient){

            array_push($ingredientArray,
                new IngredientRecipeEntity(
                    IngredientService::findByName($ingredient['id_ingredient']),
                    $ingredient['quantite'],
                    UnitService::findById($ingredient['id_unite'])
                )
            );
        }

        return $ingredientArray;
    }

    public static function add($ingredientId, $recipeId, $quantity, $unitId) {
        $db = DataBaseService::getInstance()->getDb();

        $req = $db->prepare("INSERT INTO Ingredient_Recette VALUES (?,?,?,?)");

        $req->execute([
            $ingredientId,
            $recipeId,
            $quantity,
            $unitId
        ]);

    }

    public static function deleteByRecipe($recipeId) {
        $db = DataBaseService::getInstance()->getDb();

        return $db->prepare("DELETE FROM Ingredient_Recette WHERE id_recette = ?")->execute([$recipeId]);
    }
}