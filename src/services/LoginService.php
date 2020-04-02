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

        $res = $db->query("SELECT * FROM Utilisateur WHERE email='" . $email . "' AND mot_de_passe='" . $password . "'")->fetch();

        if ($res) {

            $_SESSION['alias'] = $res['pseudo'];
            return true;
        } else {
            return false;
        }
    }

}
