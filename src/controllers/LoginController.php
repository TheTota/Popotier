<?php


class LoginController{

    public static function indexAction(){
        require_once 'bootstrap.php';


        echo $twig->render('login/login.html.twig', []);
    }
}