<?php
namespace Src\Controllers;
use Src\Services\LoginService;


class LoginController{
	
    public static function indexAction(){
        require_once 'bootstrap.php';
		require_once 'src/services/LoginService.php';


		if(isset($_POST['connexion']))
		{
				
			if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
            
				$connect = LoginService::connect($_POST['inputEmail'],$_POST['inputPassword']);
				if($connect) {
					header('Location: /home');
					
				} else {
					echo "Wrong login or password.";
					echo $twig->render('login/login.html.twig', []);
				}
			} 
		} else {
		        echo $twig->render('login/login.html.twig', []);
		}
    }
}