<?php

namespace src\controllers;

use src\services\AllergenService;
use src\services\TagService;
use src\utils\Templater;

use src\services\RecipeService;

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

    public function viewTags() {
        $twig = Templater::getInstance()->getTwig();

        $tags = TagService::fetchAll();

        echo $twig->render('admin/admin-tag.html.twig', [
            'tags' => $tags
        ]);
    }

    public function  viewAllergies() {
        $twig = Templater::getInstance()->getTwig();

        $allergens = AllergenService::fetchAll();

        echo $twig->render('admin/admin-allergy.html.twig',[
            'allergens' => $allergens
        ]);
    }
}