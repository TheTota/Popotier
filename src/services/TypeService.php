<?php

namespace src\services;

require_once 'src/services/DataBaseService.php';

require_once 'src/models/RecipeTypeEntity.php';

use src\models\RecipeTypeEntity;
use src\models\TypeEntity;

class TypeService {

    public static function fetchAll(){
        $db = DataBaseService::getInstance()->getDb();

        $types = $db->query("SELECT * FROM Type")->fetchAll();

        $typeArray = [];

        foreach ($types as $type){
            array_push($typeArray,
                new TypeEntity(
                    $type['id'],
                    $type['libelle']
                ));
        }

        return $typeArray;
    }

    public static function findById($id): RecipeTypeEntity{
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Type WHERE id = '$id'")->fetch();

        $recipeType = new RecipeTypeEntity($result['id'], $result['libelle']);

        return $recipeType;
    }

    public function add(RecipeTypeEntity $type){

    }

    public function update(RecipeTypeEntity $type){

    }

    public function delete(RecipeTypeEntity $type){

    }
}