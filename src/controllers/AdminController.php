<?php

namespace Src\Controllers;

require_once 'src/services/RecipeService.php';

use Src\Services\RecipeService;

class AdminController
{

    public function view()
    {
        $twig = \Templater::getInstance()->getTwig();

        echo $twig->render(
            'admin/admin-dashboard.html.twig'
        );

    }

    public function viewRecipes() {
        $twig = \Templater::getInstance()->getTwig();

        $recipesToValidate = RecipeService::findAllThatNeedValidation();

        echo $twig->render(
            'admin/admin-recipe.html.twig',
            [
                'recipesToValidate' => $recipesToValidate
            ]);
    }
}