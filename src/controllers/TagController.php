<?php

namespace Src\controllers;

use Src\Models\AllergenEntity;
use Src\Models\TagEntity;
use Src\Routing\RouterModule;
use Src\Services\AllergenService;
use Src\Services\TagService;

class TagController {

    public function add () {
        if(isset($_POST['inputTagName'])) {

            $tagEntity = new TagEntity(null, $_POST['inputTagName']);
            TagService::add($tagEntity);
        }
        $path = RouterModule::getInstance()->generatePath('admin_tags');
        header("location: $path");
    }

    public function delete ($tagId) {
        TagService::delete($tagId);

        $path = RouterModule::getInstance()->generatePath('admin_tags');
        header("location: $path");
    }
}