<?php

namespace Src\Controllers;

use Src\Models\AllergenEntity;
use Src\Routing\RouterModule;
use Src\Services\AllergenService;

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