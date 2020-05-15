<?php

namespace src\controllers;

use src\models\AllergenEntity;
use src\models\TagEntity;
use src\routing\RouterModule;
use src\services\AllergenService;
use src\services\TagService;

class TagController {

    public function add () {
        if(isset($_POST['inputTagName'])) {

            $tagEntity = new TagEntity(null, $_POST['inputTagName']);
            TagService::add($tagEntity);
        }
        $path = RouterModule::getInstance()->generatePath('admin_tags');
        header("location: $path");
    }

    public function delete($tagId) {
        TagService::delete($tagId);
    }

    public function update($tagId, $value){
        return TagService::update($tagId, $value);
    }
}