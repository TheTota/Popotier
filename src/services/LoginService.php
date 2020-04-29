<?php

namespace src\services;

use src\services\DataBaseService;

class LoginService
{

    public static function connect($email, $password)
    {
        $db = DataBaseService::getInstance()->getDb();

        $res = $db->query("SELECT * FROM Utilisateur WHERE email='" . $email . "'")->fetch();

        if($res){
            // TODO: don't forget to remove that, it's for dev purpose
            if ($email == 'defaultadmin@gmail.com' || $email == 'defaultuser@gmail.com') {
                $_SESSION['alias'] = $res['pseudo'];
                $_SESSION['role'] = ($res['id_role'] == '1')? 'admin' : 'user';
                $_SESSION['email'] = $res['email'];
                return true;
            }

            if (password_verify($password, $res['mot_de_passe'])) {
                $_SESSION['alias'] = $res['pseudo'];
                $_SESSION['role'] = $res['role'];
                $_SESSION['email'] = $res['email'];
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
