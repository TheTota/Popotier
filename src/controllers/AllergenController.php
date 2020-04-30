<?php

namespace src\controllers;

use src\models\AllergenEntity;
use src\routing\RouterModule;
use src\services\AllergenService;

class AllergenController{

    public function add() {
        if(isset($_POST['inputAllergenName'])) {
            $allergenEntity = new AllergenEntity(null, $_POST['inputAllergenName']);
            AllergenService::add($allergenEntity);
        }
        $path = RouterModule::getInstance()->generatePath('admin_allergies');
        header("location: $path");
    }

    public function delete($allergenId) {
        AllergenService::delete($allergenId);

        $path = RouterModule::getInstance()->generatePath('admin_allergies');
        header("location: $path");
    }

}