<?php

namespace src\services;


use src\models\IngredientEntity;
use src\models\IngredientRecipeEntity;

class IngredientService
{

    public static function fetchAll()
    {
        $db = DataBaseService::getInstance()->getDb();

        $ingredients = $db->query("SELECT * FROM Ingredient");

        return self::createIngredientArray($ingredients);
    }

    public static function findByName($name)
    {
        $db = DataBaseService::getInstance()->getDb();

        $ingredient = $db->query("SELECT * FROM Ingredient WHERE nom = '$name'")->fetch();

        if(!$ingredient)
            return $ingredient;

        $ingredient = new IngredientEntity(
            $ingredient['nom'],
            ($ingredient['id_allergene'] == null) ? null : AllergenService::findById($ingredient['id_allergene'])
        );

        return $ingredient;
    }

    public static function add(IngredientEntity $ingredient)
    {
        $db = DataBaseService::getInstance()->getDb();

        $req = $db->prepare("INSERT INTO Ingredient VALUES (?,?) ");

        $response = $req -> execute([
            $ingredient->getName(),
            $ingredient->getAllergen()
        ]);
    }

    public function update(IngredientEntity $ingredient)
    {

    }

    public function delete(IngredientEntity $ingredient)
    {

    }

    public static function updateAllergen($ingredientName, $allergenId) {
        $db = DataBaseService::getInstance()->getDb();



        if($allergenId == ''){
            return $db->prepare("UPDATE Ingredient SET id_allergene = NULL WHERE nom = ? ")->execute([$ingredientName]);
        } else {
            return $db->prepare("UPDATE Ingredient SET id_allergene = ? WHERE nom = ? ")->execute([$allergenId, $ingredientName]);
        }

    }

    private static function createIngredientArray(\PDOStatement $ingredients): array
    {
        $ingredientArray = array();
        foreach ($ingredients as $ingredient) {
            array_push(
                $ingredientArray,
                new IngredientEntity(
                    $ingredient['nom'],
                    $ingredient['id_allergene']
                )
            );
        }
        return $ingredientArray;
    }


}