<?php


namespace src\controllers;


use src\services\RatingService;

class RatingController
{

    public function rate($recipeId, $value) {
        // if connected, like the recipe
        if (isset($_SESSION['email'])) {
            $userId = $_SESSION['id'];
            RatingService::insertRating($recipeId, $userId, $value);
        } else { // not connected, redirect towards login page
            header('location: /login');
        }
    }

}