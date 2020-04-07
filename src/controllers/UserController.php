<?php

require_once 'src/utils/Templater.php';
require_once 'src/models/UserEntity.php';
require_once 'src/services/RoleService.php';
require_once 'src/services/UserService.php';

use Src\Models\UserEntity;
use Src\Services\UserService;
use Src\Services\RoleService;

class UserController{

    // routing : /user/add
    public static function addAction(){
        $twig = Templater::getInstance()->getTwig();

        if(!empty($_POST)){

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
    public static function aliasVerify($alias){
        if(UserService::aliasExist($alias)){
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
    public static function emailVerify($email){
        if(UserService::emailExists($email)){
            echo false;
        } else {
            echo true;
        }
    }
}