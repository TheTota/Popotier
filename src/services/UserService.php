<?php

namespace src\services;

require_once 'src/models/UserEntity.php';

require_once 'src/services/RoleService.php';

use src\models\RoleEntity;
use src\models\UserEntity;

class UserService
{

    public function fetchAll()
    {

    }

    public static function findByEmail($email)
    {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Utilisateur WHERE email LIKE '$email'")->fetch();

        $user = new UserEntity(
            $result['email'],
            $result['nom'],
            $result['prenom'],
            $result['pseudo'],
            $result['mot_de_passe'],
            RoleService::findById($result['id_role'])
        );

        return $user;
    }

    public static function add(UserEntity $user)
    {
        $db = DataBaseService::getInstance()->getDb();

        $request = $db->prepare("INSERT INTO Utilisateur VALUES (?, ?, ?, ?, ?, ?)");

        $request->execute([
            $user->getEmail(),
            $user->getLastName(),
            $user->getFirstName(),
            $user->getAlias(),
            password_hash($user->getPassword(), PASSWORD_DEFAULT),
            $user->getRole()->getId()
        ]);
    }

    public function update(UserEntity $user)
    {

    }

    public function delete(UserEntity $user)
    {

    }

    public static function aliasExist($alias){
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT pseudo from Utilisateur WHERE pseudo LIKE '$alias'")->fetch();

        if($result){
            return true;
        } else {
            return false;
        }
    }

    public static function emailExists($email){
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT email from Utilisateur WHERE email LIKE '$email'")->fetch();

        if($result){
            return true;
        } else {
            return false;
        }
    }


}