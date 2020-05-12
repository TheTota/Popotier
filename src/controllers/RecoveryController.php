<?php
namespace src\controllers;

use src\services\LoginService;
use src\services\UserService;
use src\utils\Templater;



class RecoveryController{

    /**
     * Action called when the password recovery page is loaded.
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function view(){
        $twig = Templater::getInstance()->getTwig();

        // check if entered mail and clicked on button
        if (isset($_POST['recovery'])) {
            // only send mail if the given email is linked to an activated account
            // TODO: make the link available for a few hours only
            $targetMail = $_POST['inputEmail'];
            if (UserService::emailExists($targetMail) && UserService::userValidated($targetMail)) {
                echo "<h1>SEND A MAIL!!! </h1>";
            }

            // update render to say signal an email has been sent
            echo $twig->render('login/password-recovery.html.twig', ["recoveryMailSent" => true]);
        } else {
            echo $twig->render('login/password-recovery.html.twig', []);
        }
    }

}