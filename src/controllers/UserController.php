<?php

namespace Src\Controllers;

use Src\Utils\Templater;

use Src\Services\UserService;
use Src\Services\RoleService;
use Src\Services\RecipeService;

use Src\Models\UserEntity;

class UserController
{

    public function index()
    {
        echo Templater::getInstance()->getTwig()->render('user/user.html.twig', []);
    }

    // routing : /user/add
    public function add()
    {
        $twig = Templater::getInstance()->getTwig();

        if (!empty($_POST)) {

            $user = new UserEntity(
                $_POST['email'],
                $_POST['lastName'],
                $_POST['firstName'],
                $_POST['alias'],
                $_POST['password'],
                RoleService::findByName('Utilisateur')
            );

            UserService::add($user);
            echo $twig->render('user/user-create.html.twig', ["userCreated" => "true"]);
            return;
        }

        echo $twig->render('user/user-create.html.twig');
    }

    /**
     * @param $alias The alias choosed by the user
     *
     * This function is used to check with an ajax call if the alias is already used by another user
     *
     * Returns false if the user can not use this alias or true if he can
     *
     * Route: user/verify/alias
     */
    public function aliasVerify($alias)
    {
        if (UserService::aliasExist($alias)) {
            echo false;
        } else {
            echo true;
        }
    }

    /**
     * @param $email The email choosed by the user
     *
     * This function is used to check with an ajax call if the email is already used by another user
     *
     * Returns false if the user can not use this email or true if he can
     *
     * Route: user/verify/email
     */
    public function emailVerify($email)
    {
        if (UserService::emailExists($email)) {
            echo false;
        } else {
            echo true;
        }
    }

    /**
     * This function is used to view all the user's recipes.
     */
    public function viewRecipe()
    {
        $recipes = RecipeService::fetchAllUserRecipe($_SESSION['email']);
        echo Templater::getInstance()->getTwig()->render('user/user-recipe-list.html.twig',
            [
                'recipes' => $recipes,
                'recipeList' => true
            ]
        );
    }

    public function viewFavorite()
    {
        $recipes = RecipeService::fetchAllUserFavoriteRecipe($_SESSION['email']);
        echo Templater::getInstance()->getTwig()->render('user/user-recipe-list.html.twig', ['recipes' => $recipes]);
    }


}

