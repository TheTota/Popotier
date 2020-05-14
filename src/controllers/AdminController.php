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

    // Route "admin_recipes_to_validate" => /admin/view/recipes-to-validate
    public function viewRecipesToValidate() {
        $twig = Templater::getInstance()->getTwig();

        $recipesToValidate = RecipeService::findByValidation(false);

        echo $twig->render(
            'admin/admin-recipe.html.twig',
            [
                'recipes' => $recipesToValidate
            ]);
    }

    // Route "admin_validated_recipes" => /admin/view/validated-recipes
    public function viewValidatedRecipes() {
        $twig = Templater::getInstance()->getTwig();

        $validatedRecipes = RecipeService::findByValidation(true);

        echo $twig->render(
            'admin/admin-recipe.html.twig',
            [
                'recipes' => $validatedRecipes
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