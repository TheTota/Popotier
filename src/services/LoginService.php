<?php

namespace Src\Services;
require_once('src/services/DatabaseService.php');

use Src\Services\DatabaseService;

class LoginService {

		private $db;

		public static function connect($email, $password) {

			$db =  DataBaseService::getInstance();
			$req = $db->getDb()->prepare( "SELECT * FROM Utilisateur WHERE email =:email AND mot_de_passe =:mot_de_passe");
			$req->execute(array('email' => $email, 'mot_de_passe' => $password)); 
			$res = $req->fetchAll();
			return $res;
	}

}
