<?php

namespace src\services;

require_once 'src/models/StepEntity.php';

use src\models\StepEntity;

class StepService{

    public function fetchAll(){

    }

    public function findById($id){

    }

    public static function add(StepEntity $step, $recipeId){
        $db = DataBaseService::getInstance()->getDb();

        //var_dump($recipeId);die;

        $req = $db->prepare("INSERT INTO Etape VALUES (?,?,?,?)");

        $req->execute([
            null,
            $step->getPosition(),
            $step->getDescription(),
            $recipeId
        ]);
    }

    public function update(StepEntity $step){

    }

    public function delete(StepEntity $step){

    }

    public static function findByRecette($id_recette){
        $db = DataBaseService::getInstance()->getDb();

        $steps = $db->query("SELECT * FROM Etape WHERE id_recette = '$id_recette'");

        $stepArray = array();
        foreach ($steps as $step){
            array_push(
                $stepArray,
                new StepEntity(
                    $step['id'],
                    $step['position'],
                    $step['description']
                )
            );
        }

        return $stepArray;
    }
}