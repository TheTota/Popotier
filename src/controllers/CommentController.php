<?php


namespace src\controllers;


use src\services\CommentService;

class CommentController
{

    public function comment($recipeId, $value) {
        // if connected, like the recipe
        if (isset($_SESSION['email'])) {
            $userId = $_SESSION['id'];
            // check if user already rated
            CommentService::insertComment($recipeId, $userId, $value);
        } else { // not connected, redirect towards login page
            header('location: /login');
        }
    }

}