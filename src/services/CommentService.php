<?php

namespace src\services;

use src\models\CommentEntity;

class CommentService{

    public static function insertComment($recipeId, $userId, $value)
    {
        $db = DataBaseService::getInstance()->getDb();

        $req = $db->prepare("INSERT INTO Commentaire (description, date_publication, id_auteur, id_recette) VALUES (:val, now(), :userId, :recipeId)");

        $data = [
            'val' => $value,
            'recipeId' => $recipeId,
            'userId' => $userId
        ];

        $req->execute($data);
    }

    public function fetchAll(){

    }

    public function findById($id){

    }

    public function add(CommentEntity $comment){

    }

    public function update(CommentEntity $comment){

    }

    public function delete(CommentEntity $comment){

    }
}