<?php

namespace src\services;

require_once 'src/services/DataBaseService.php';

class RatingService {

    public static function insertRating($recipeId, $userId, $value) {
        $db = DataBaseService::getInstance()->getDb();

        $req = $db->prepare("INSERT INTO Note (valeur, id_recette, id_utilisateur) VALUES (:val, :recipeId, :userId)");

        $data = [
            'val' => $value,
            'recipeId' => $recipeId,
            'userId' => $userId
        ];

        $req->execute($data);
    }

    public static function getAverageRating($recipeId) {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT avg(valeur) FROM Note WHERE id_recette = '$recipeId'")->fetch();

        if ($result == false) {
            return 0;
        } else {
            return $result[0];
        }
    }

    public static function userAlreadyRated($recipeId, $userId)
    {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Note WHERE id_utilisateur = '$userId' AND id_recette = '$recipeId'")->fetch();
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public static function updateRating($recipeId, $userId, $value)
    {
        $db = DataBaseService::getInstance()->getDb();

        $db->exec("UPDATE Note SET valeur = '$value' WHERE id_utilisateur = '$userId' AND id_recette = '$recipeId'");
        return;
    }

}