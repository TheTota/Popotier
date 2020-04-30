<?php
namespace src\controllers;

use src\services\LoginService;
use src\utils\Templater;



class LoginController{

    public function login(){
        $twig = Templater::getInstance()->getTwig();

		if(isset($_POST['connexion']))
		{
			if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){

				if(LoginService::connect($_POST['inputEmail'],$_POST['inputPassword'])) {
					header('Location: /home');

				} else {
					//echo "Wrong login or password.";
					echo $twig->render('login/login.html.twig', ['loginError' => true]);
				}
			} 
		} else {
		        echo $twig->render('login/login.html.twig', []);
		}
    }

    public function logout() {
        session_start();
        session_destroy();

        header('location: /login');
    }
}