<?php

namespace src\controllers;

use src\models\IngredientEntity;
use src\models\IngredientRecipeEntity;
use src\models\RecipeTypeEntity;
use src\models\TagEntity;
use src\services\AllergenService;
use src\services\CommentService;
use src\services\FileUploadService;
use src\services\IngredientRecipeService;
use src\services\IngredientService;
use src\services\RatingService;
use src\services\StepService;
use src\services\TagService;
use src\services\UnitService;
use src\utils\Templater;
use src\services\RecipeService;
use src\services\UserService;
use src\services\RecipeTypeService;
use src\models\RecipeEntity;
use src\models\StepEntity;

class RecipeController
{
    /**
     * @param $recipeId
     * Route: /recipe/view/id
     * Name: view_recipe
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function view($recipeId)
    {
        $twig = Templater::getInstance()->getTwig();

        $recipe = RecipeService::findById($recipeId);
        // if user connected
        $recipeLikedByUser = false;
        $userRating = 0;
        if (isset($_SESSION['email'])) {
            $recipeLikedByUser = RecipeService::recipeIsLiked($_SESSION['id'], $recipeId);
            $userRating = RatingService::getUserRating($_SESSION['id'], $recipeId);
        }

        // get recipe average rating
        $recipeAverageRating = RatingService::getAverageRating($recipeId);

        // get recipe comments if any
        $recipeComments = CommentService::fetchRecipeComments($recipeId);

        echo $twig->render('recipe/recipe-view.html.twig', [
            'recipe' => $recipe,
            'recipeLiked' => $recipeLikedByUser,
            'recipeAverageRating' => $recipeAverageRating,
            'userRating' => $userRating,
            'recipeComments' => $recipeComments
        ]);
    }

    public static function add()
    {
        $twig = Templater::getInstance()->getTwig();
        $recipeCreated = false;

        if (!empty($_POST)) {
            $steps = array();

            // If there is an error on the image upload
            if (!FileUploadService::uploadFile()) {

            };

            $recipe = new RecipeEntity(
                null, // id
                $_POST['inputName'],
                $_FILES['fileToUpload']['name'],
                null, //date creation
                $_POST['inputCookingTime'],
                $_POST['inputPreparationTime'],
                $_POST['inputPersonNumber'],
                $_POST['inputDifficulty'],
                $_POST['inputMeanPrice'],
                $_POST['inputAuthorQuote'],
                0, //valid
                UserService::findByEmail($_SESSION['email']),
                RecipeTypeService::findById($_POST['inputType']),
                null, // admin
                null, // steps
                null //ingredients
            );
            $recipeId = RecipeService::add($recipe);

            $tags = explode(',', $_POST['inputTag']);

            foreach ($tags as $tag) {
                if ($tagEntity = TagService::findByName($tag) != false) {
                    TagService::addTagToRecipe($tagEntity->getId(), $recipeId);
                } else {
                    $tagId = TagService::add(
                        new TagEntity(null, $tag)
                    );
                    TagService::addTagToRecipe($tagId, $recipeId);
                }
            }

            for ($i = 1; $i <= count($_POST['stepList']); $i++) {
                StepService::add(new StepEntity(null, $i, $_POST['stepList'][$i - 1]), $recipeId);
            }

            for ($i = 0; $i < count($_POST['ingredients']); $i++) {
                if (IngredientService::findByName($_POST['ingredients'][$i]) == false) {
                    IngredientService::add(
                        new IngredientEntity(
                            $_POST['ingredients'][$i],
                            null
                        )
                    );
                }
                IngredientRecipeService::add(
                    $_POST['ingredients'][$i],
                    $recipeId,
                    $_POST['quantity'][$i],
                    $_POST['unit'][$i]
                );
            }

            // ALLERGENS
            foreach ($_POST['allergen'] as $key => $allergenId) {
                if ($key + 1 != count($_POST['ingredients'])) {
                    IngredientService::updateAllergen($_POST['ingredients'][$key], $allergenId);
                }
            }

            $recipeCreated = true;

            echo $twig->render('recipe/recipe-create.html.twig', ["recipeCreated" => $recipeCreated]);
            return;
        }

        echo $twig->render('recipe/recipe-create.html.twig', [
            'recipeTypes' => RecipeTypeService::fetchAll(),
            'ingredients' => IngredientService::fetchAll(),
            'units' => UnitService::fetchAll(),
            'allergens' => AllergenService::fetchAll()
        ]);
    }

    public function update($recipeId)
    {
        $twig = Templater::getInstance()->getTwig();
        $recipeEntity = RecipeService::findById($recipeId);

        if (!empty($_POST)) {

            StepService::deleteByRecipe($recipeId);
            IngredientRecipeService::deleteByRecipe($recipeId);

            // TAGS
            $tags = explode(',', $_POST['inputTag']);
            TagService::deleteByRecipe($recipeId);
            foreach ($tags as $tag) {
                if ($tagEntity = TagService::findByName($tag) != false) {
                    TagService::addTagToRecipe($tagEntity->getId(), $recipeId);
                } else {
                    $tagId = TagService::add(
                        new TagEntity(null, $tag)
                    );
                    TagService::addTagToRecipe($tagId, $recipeId);
                }
            }

            // STEPS
            foreach ($_POST['stepList'] as $key => $step) {
                if ($key + 1 != count($_POST['stepList'])) {
                    StepService::add(new StepEntity(
                        null,
                        $key++,
                        $step
                    ),
                        $recipeId
                    );
                }
            }

            // INGREDIENTS
            foreach ($_POST['ingredients'] as $key => $ingredient) {
                if ($key + 1 != count($_POST['ingredients'])) {
                    IngredientRecipeService::add(
                        $ingredient,
                        $recipeId,
                        $_POST['quantity'][$key],
                        $_POST['unit'][$key]
                    );
                }
            }

            // ALLERGENS
            foreach ($_POST['allergen'] as $key => $allergenId) {
                if ($key + 1 != count($_POST['ingredients'])) {
                    IngredientService::updateAllergen($_POST['ingredients'][$key], $allergenId);
                }
            }

            $type = new RecipeTypeEntity($_POST['inputType'], null);

            $recipeEntity = new RecipeEntity(
                $recipeId,
                $_POST['inputName'],
                $recipeEntity->getImage(),
                $recipeEntity->getCreationDate(),
                $_POST['inputCookingTime'],
                $_POST['inputPreparationTime'],
                $_POST['inputPersonNumber'],
                $_POST['inputDifficulty'],
                $_POST['inputMeanPrice'],
                $_POST['inputAuthorQuote'],
                $recipeEntity->getValid(),
                $recipeEntity->getAuthor(),
                $type,
                $recipeEntity->getAdmin(),
                $recipeEntity->getSteps(),
                $recipeEntity->getIngredients()
            );

            RecipeService::update($recipeEntity);

            header("location: /recipe/view/$recipeId");

        } else {
            echo $twig->render('recipe/recipe-create.html.twig', [
                'update' => true,
                'recipeTypes' => RecipeTypeService::fetchAll(),
                'ingredients' => IngredientService::fetchAll(),
                'units' => UnitService::fetchAll(),
                'allergens' => AllergenService::fetchAll(),
                'recipe' => $recipeEntity,
                'tags' => implode(',', TagService::findByRecipe($recipeId))
            ]);
        }
    }

    public function delete($recipeId)
    {
        RecipeService::deleteByID($recipeId);
    }

    /**
     * Route: /recipe/summary/:id
     */
    public function summary($recipeId)
    {
        $twig = Templater::getInstance()->getTwig();

        $recipe = RecipeService::findById($recipeId);

        echo $twig->render(
            'recipe/recipe-resume-template.twig',
            [
                'recipe' => $recipe
            ]
        );
    }

    /**
     * Route: /recipe/validate/:id
     */
    public function validate($recipeId)
    {
        $recipe = RecipeService::findById($recipeId);

        $recipe->setValid(true);
        $recipe->setAdmin(UserService::findByEmail($_SESSION['email']));

        if (RecipeService::update($recipe)) {
            echo true;
        } else {
            echo false;
        }
    }

    /**
     * Route: /recipe/validate/:id
     */
    public function devalidate($recipeId)
    {
        $recipe = RecipeService::findById($recipeId);

        $recipe->setValid(false);
        $recipe->setAdmin(UserService::findByEmail($_SESSION['email']));

        if (RecipeService::update($recipe)) {
            echo true;
        } else {
            echo false;
        }
    }

    /**
     * Route: /recipe/like/:id
     */
    public function like($recipeId)
    {
        // if connected, like the recipe
        if (isset($_SESSION['email'])) {
            $userId = $_SESSION['id'];
            if (RecipeService::recipeIsLiked($userId, $recipeId)) {
                RecipeService::dislikeRecipe($userId, $recipeId);
            } else {
                RecipeService::likeRecipe($userId, $recipeId);
            }
        } else { // not connected, redirect towards login page
            header('location: /login');
        }
    }

    public function searchByString($normalizedSearchString)
    {
        $twig = Templater::getInstance()->getTwig();

        $recipes = RecipeService::searchByName($normalizedSearchString);

        echo $twig->render("recipe/components/recipe-search-component.html.twig", ["recipes" => $recipes]);
    }
}
