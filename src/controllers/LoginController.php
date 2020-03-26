<?php
namespace Src\Controllers;
require_once 'src/services/LoginService.php';
use Src\Services\LoginService;



class LoginController{


	
    public static function loginAction(){
        $twig = \Templater::getInstance()->getTwig();

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
				echo 'hey';
		}
    }

    public static function logoutAction() {
        session_start();
        session_destroy();

        header('location: /login');
    }
}