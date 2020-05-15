<?php

namespace src\controllers;

use src\services\RecipeService;

class RecipeApiController {

    public function viewAll(){
        //HEADERS
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access_Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            //$donnees_recues = json_decode(file_get_contents("php://input"));

            //if(!empty($donnees_recues->id)) {


                $donnees_a_envoyer = RecipeService::fetchAll();

                if($donnees_a_envoyer !== NULL){
                    // 200 OK
                    http_response_code(200);

                    echo json_encode($donnees_a_envoyer);
                }else{
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
}