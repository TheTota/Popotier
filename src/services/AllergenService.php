<?php

namespace Src\Services;

use Src\Models\AllergenEntity;

class AllergenService {

    public static function fetchAll() {
        $db = DataBaseService::getInstance()->getDb();

        $allergens = $db->query("SELECT * FROM Allergene")->fetchAll();

        $allergenArray = [];

        foreach ($allergens as $allergen){
            array_push($allergenArray,
                new AllergenEntity(
                    $allergen['id'],
                    $allergen['nom']
                )
            );
        }

        return $allergenArray;
    }

    public static function add($allergenEntity) {
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("INSERT INTO Allergene (nom) VALUES (?);")->execute([$allergenEntity->getName()]);
    }

    public static function update($allergenEntity) {

    }

    public static function delete($allergenId) {
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("DELETE FROM Allergene WHERE id = ?")->execute([$allergenId]);
    }



}