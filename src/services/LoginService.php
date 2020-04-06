<?php

namespace Src\Services;
require_once('src/services/DataBaseService.php');

use Src\Services\DatabaseService;

class LoginService
{

    private $db;

    public static function connect($email, $password)
    {
        $db = DataBaseService::getInstance()->getDb();

        $res = $db->query("SELECT * FROM Utilisateur WHERE email='" . $email . "'")->fetch();

        if($res){
            // TODO: don't forget to remove that, it's for dev purpose
            if ($email == 'defaultadmin@gmail.com') {
                $_SESSION['alias'] = $res['pseudo'];
                return true;
            }

            if (password_verify($password, $res['mot_de_passe'])) {
                $_SESSION['alias'] = $res['pseudo'];
                $_SESSION['role'] = $res['role'];
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
