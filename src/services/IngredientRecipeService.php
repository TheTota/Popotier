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
}