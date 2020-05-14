<?php

namespace src\services;

use src\models\AllergenEntity;

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

    public static function update($allergenId, $name) {
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("UPDATE Allergene SET nom = '$name' WHERE id = '$allergenId'")->execute();
    }

    public static function delete($allergenId) {
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("DELETE FROM Allergene WHERE id = ?")->execute([$allergenId]);
    }

    public static function findById($allergenId) {
        $db = DataBaseService::getInstance()->getDb();

        $allergen = $db->query("SELECT * FROM Allergene WHERE id = '$allergenId'")->fetch();

        return new AllergenEntity(
            $allergen['id'],
            $allergen['nom']
        );
    }



}