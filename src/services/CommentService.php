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

    public static function fetchRecipeComments($recipeId)
    {
        $db = DataBaseService::getInstance()->getDb();

        $comments = $db->query("SELECT * FROM Commentaire WHERE id_recette = '$recipeId' ORDER BY date_publication DESC")->fetchAll();

        $commentsArray = [];
        foreach ($comments as $comment){
            array_push($commentsArray,
                new CommentEntity(
                    $comment['id'],
                    $comment['date_publication'],
                    $comment['description'],
                    $comment['id_recette'],
                    UserService::findById($comment['id_auteur'])
                )
            );
        }

        return $commentsArray;
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