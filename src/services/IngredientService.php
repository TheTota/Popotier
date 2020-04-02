<?php

namespace Src\Services;

use Src\Models\IngredientEntity;

class IngredientService{

    public function fetchAll(){

    }

    public function findById($id){
        $db = DataBaseService::getInstance()->getDb();

        $result = query("SELECT * FROM Ingredient WHERE id = '$id'")->fetch();

        $ingredient = new IngredientEntity(

        );

        return $ingredient;
    }

    public function add(IngredientEntity $ingredient){

    }

    public function update(IngredientEntity $ingredient){

    }

    public function delete(IngredientEntity $ingredient){

    }
}