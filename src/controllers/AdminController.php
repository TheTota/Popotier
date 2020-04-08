<?php

namespace Src\Controller;

require_once 'src/services/RecipeService.php';

use Src\Services\RecipeService;

class AdminController
{

    public static function viewAction()
    {
        $twig = \Templater::getInstance()->getTwig();

        //TODO: Get all recipes that need validation
        $recipesToValidate = RecipeService::findAllThatNeedValidation();

        echo $twig->render(
            'admin/admin-page.html.twig',
            [
                'recipesToValidate' => $recipesToValidate
            ]);
    }
}