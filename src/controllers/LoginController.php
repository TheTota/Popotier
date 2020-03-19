<?php

namespace Src\Controllers;

class LoginController{
	


    public static function indexAction(){
        require_once 'bootstrap.php';



		if(isset($_POST['connexion']))
		{
			echo "something";
				
			if(isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
            
				//à mettre dans la classe Utilisateur
				//$req = $bdd->getDb()->prepare( "SELECT * FROM utilisateur WHERE login =:login AND mdp =:password");
				//$req->execute(array('login' => $_POST['login'], 'password' => $_POST['password'])); 
     
				//if($res = $req->fetchAll()) {
					echo "Success";
                
				//} else {
					echo "Invalid values";
				//}
            	

			} else {
				echo "Login and password are required";
			}
		} else {
		        echo $twig->render('login/login.html.twig', []);
		}


		
    }


}