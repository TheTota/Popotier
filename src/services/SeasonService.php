<?php

namespace src\services;

use src\models\RecipeSeasonEntity;
use src\models\SeasonEntity;

class SeasonService{

    public static function fetchAll(){
        $db = DataBaseService::getInstance()->getDb();

        $seasons = $db->query("SELECT * FROM Saison")->fetchAll();

        $seasonArray = [];

        foreach ($seasons as $season){
            array_push($seasonArray,
                new SeasonEntity(
                    $season['id'],
                    $season['libelle']
                ));
        }

        return $seasonArray;
    }

    public function findById($id){

    }

    public function add(RecipeSeasonEntity $season){

    }

    public function update(RecipeSeasonEntity $season){

    }

    public function delete(RecipeSeasonEntity $season){

    }
}