<?php

namespace src\controllers;

use http\Client\Curl\User;
use src\services\DataBaseService;
use src\services\MailerService;
use src\utils\StringGenerator;
use src\utils\Templater;

use src\services\UserService;
use src\services\RoleService;
use src\services\RecipeService;

use src\models\UserEntity;

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
                null,
                strtolower($_POST['email']),
                $_POST['lastName'],
                $_POST['firstName'],
                $_POST['alias'],
                password_hash($_POST['password'], PASSWORD_DEFAULT),
                RoleService::findByName('Utilisateur'),
                false,
                StringGenerator::generateRandomString(30)
            );

            if (UserService::add($user) == null)
                MailerService::sendMail(
                    $user->getEmail(),
                    $user->getLastName() . ' ' . $user->getFirstName(),
                    'Verifiez votre email',
                    $twig->render('user/mail/confirmation-mail-template.html.twig', ['user' => $user]));

            echo $twig->render('user/user-create.html.twig', ["userCreated" => "true"]);
            return;
        }

        echo $twig->render('user/user-create.html.twig');
    }

    public function update(){
        $twig = Templater::getInstance()->getTwig();

        if (!empty($_POST)) {
            $user = UserService::findById($_SESSION['id']);

            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));

            UserService::update($user);

            echo $twig->render('user/user-update.html.twig', ['updated' => true]);
        }

        echo $twig->render('user/user-update.html.twig', ['updated' => false]);
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
        echo Templater::getInstance()->getTwig()->render('user/user.html.twig');
    }

    public function viewRecipeListByAlias($alias,$page = null)
    {
        $twig = Templater::getInstance()->getTwig();
        $user = UserService::findByAlias($alias);
        $recipes = RecipeService::fetchAllUserRecipe($user->getId());
        $recipeCount = RecipeService::countUserRecipes($user->getId());
        $pages = round($recipeCount/2);
        $logged = false;

        if($_SESSION != null) 
        {
            $logged = true;  
            if($alias == $_SESSION['alias']) 
            {
                header('Location: /user/view/recipe-list');
			}
		}
        echo $twig->render('user/user-public.html.twig', [
            'recipes' => $recipes,
            'alias' => $alias,
            'pages' => $pages,
            'logged' => $logged
        ]);
	}


    public function getUserRecipeList($page = null) {
        $twig = Templater::getInstance()->getTwig();
        $recipes = RecipeService::fetchAllUserRecipePaginated($_SESSION['id'], $page);
        $recipeCount = RecipeService::countUserRecipes($_SESSION['id']);
        $pages = round($recipeCount/2);

        echo $twig->render('user/components/recipe-buttons-component.html.twig', [
            'recipes' => $recipes,
            'pages' => $pages
        ]);
    }

    public function getUserLikedRecipeList($page = null) {
        $twig = Templater::getInstance()->getTwig();
        $recipes = RecipeService::fetchAllUserFavoriteRecipePaginated($_SESSION['id'], $page);
        $recipeCount = RecipeService::countUserRecipes($_SESSION['id']);
        $pages = round($recipeCount/2);

        echo $twig->render('user/components/recipe-like-component.html.twig', [
            'recipes' => $recipes,
            'pages' => $pages
        ]);
    }

    public function getUserRecipePageCount() {
        $recipeCount = RecipeService::countUserRecipes($_SESSION['id']);

        echo round($recipeCount/2);
    }

    public function getUserLikedRecipePageCount() {
        $recipeCount = RecipeService::countUserLikedRecipes($_SESSION['id']);

        echo round($recipeCount/2);
    }

    public function emailConfirmation($validationString)
    {
        $user = UserService::findByValidationString($validationString);

        UserService::validateUser($user->getEmail());

        $twig = Templater::getInstance()->getTwig();
        echo $twig->render('user/mail/user-mail-confirmed.html.twig');
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

