<?php
namespace src\controllers;

use src\services\LoginService;
use src\utils\Templater;



class RecoveryController{

    public function view(){
        $twig = Templater::getInstance()->getTwig();

        if (isset($_POST['recovery'])) {
            echo $twig->render('login/password-recovery.html.twig', ["recoveryMailSent" => true]);
        } else {
            echo $twig->render('login/password-recovery.html.twig', []);
        }
    }

}