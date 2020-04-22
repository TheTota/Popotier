<?php

namespace Src\Services;

use Src\Models\IngredientEntity;

class IngredientService
{

    public function fetchAll()
    {

    }

    public function findById($id)
    {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Ingredient WHERE id = '$id'")->fetch();

        $ingredient = new IngredientEntity();

        return $ingredient;
    }

    public function add(IngredientEntity $ingredient)
    {

    }

    public function update(IngredientEntity $ingredient)
    {

    }

    public function delete(IngredientEntity $ingredient)
    {

    }

    public static function findAllByRecipe($recipeId)
    {
        $db = DataBaseService::getInstance()->getDb();

        $query = $db->query("
                            SELECT * 
                            FROM Ingredient I 
                            JOIN Ingredients_Recette IR ON I.id = IR.id_ingredient  
                            WHERE id_recette = '$recipeId'");

        if($query)
            $ingredients = $query->fetch();
        else
            return null;

        $ingredientArray = [];

        foreach ($ingredients as $ingredient){
            array_push($ingredientArray,
                new IngredientEntity(
                $ingredient['id'],
                $ingredient['nom'],
                $ingredient['quantite']
                )
            );
        }

        return $ingredientArray;
    }
}