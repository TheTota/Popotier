<?php

namespace Src\Controllers;

use Src\Utils\Templater;

use Src\Services\RecipeService;

class AdminController
{

    public function view()
    {
        $twig = Templater::getInstance()->getTwig();

        echo $twig->render(
            'admin/admin-dashboard.html.twig'
        );

    }

    public function viewRecipes() {
        $twig = Templater::getInstance()->getTwig();

        $recipesToValidate = RecipeService::findAllThatNeedValidation();

        echo $twig->render(
            'admin/admin-recipe.html.twig',
            [
                'recipesToValidate' => $recipesToValidate
            ]);
    }
}