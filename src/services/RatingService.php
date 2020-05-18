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

        $result = $db->query("SELECT * FROM Unite WHERE id = '$recipeId'")->fetch();

        if ($result == false) {
            return false;
        } else {
            return $result;
        }
    }

}