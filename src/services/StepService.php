<?php

namespace Src\Services;

require_once 'src/models/StepEntity.php';

use Src\Models\StepEntity;

class StepService{

    public function fetchAll(){

    }

    public function findById($id){

    }

    public function add(StepEntity $step){

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