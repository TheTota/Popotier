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

            var_dump($user);

            UserService::add($user);
        }


        echo $twig->render('user/user-create.html.twig');
    }

    public static function aliasVerify($alias){
        if(UserService::aliasExist($alias)){
            echo false;
        } else {
            echo true;
        }
    }

    public static function emailVerify($email){
        if(UserService::emailExists($email)){
            echo false;
        } else {
            echo true;
        }
    }
}