<?php

namespace Src\Services;


use Src\Models\IngredientEntity;
use Src\Models\IngredientRecipeEntity;

class IngredientService
{

    public function fetchAll()
    {

    }

    public static function findByName($name)
    {
        $db = DataBaseService::getInstance()->getDb();

        $ingredient = $db->query("SELECT * FROM Ingredient WHERE nom = '$name'")->fetch();

        $ingredient = new IngredientEntity(
            $ingredient['nom'],
            ($ingredient['id_allergene'] == null) ? null : AllergenService::findById($ingredient['id_allergene'])
        );

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


}