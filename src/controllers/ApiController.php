<?php

namespace src\controllers;

use src\services\IngredientService;
use src\services\RecipeService;

class ApiController
{

    private function setHeaders() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access_Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    /**
     * method: GET
     * route: api/recipe
     * return: List of all recipes
     */
    public function getAllRecipes()
    {
        //HEADERS
        self::setHeaders();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $recipes = RecipeService::fetchAll();

            if ($recipes !== NULL) {
                // 200 OK
                http_response_code(200);
                echo json_encode($recipes);
            } else {
                // 404 Not found
                http_response_code(404);
                echo json_encode(array("message" => "La donnée n'existe pas."));
            }
            //}
        } else {
            http_response_code(405);
            echo json_encode(["message" => "La méthode utilisée est incorrecte"]);
        }
    }

 /**
 * method: GET
 * route: api/recipe/{id}
 * return: The recipe specified by the id or null if the id doest'n exist
 * @param $id
 */
    public function getRecipeById($id)
    {
        //HEADERS
        self::setHeaders();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $recipe = RecipeService::findById($id);

            if ($recipe !== null) {
                // 200 OK
                http_response_code(200);
                echo json_encode($recipe);
            } else {
                // 404 Not found
                http_response_code(404);
                echo json_encode(array("message" => "La donnée n'existe pas."));
            }

        } else {
            http_response_code(405);
            echo json_encode(["message" => "La méthode utilisée est incorrecte"]);
        }
    }

    /**
     * method: GET
     * route: api/ingredients
     * return: List of all Ingredients
     */
    public function getAllIngredients()
    {
        // TODO: to do later
    }

}