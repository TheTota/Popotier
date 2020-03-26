<?php

namespace Src\Services;
require_once('src/services/DatabaseService.php');

use Src\Services\DatabaseService;

class LoginService
{

    private $db;

    public static function connect($email, $password)
    {

        $db = DataBaseService::getInstance()->getDb();
        $userExists = false;
        $req = $db->query("SELECT * FROM Utilisateur WHERE email='" . $email . "' AND mot_de_passe='" . $password . "'")->fetch();

        if ($req) {
            $userExists = true;
            session_start();
			$_SESSION['email'] = $email;
            return $userExists;
        } else {
            return $userExists;
        }
    }

}
