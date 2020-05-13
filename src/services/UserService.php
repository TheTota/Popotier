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
            $result['id'],
            $result['email'],
            $result['nom'],
            $result['prenom'],
            $result['pseudo'],
            $result['mot_de_passe'],
            RoleService::findById($result['id_role'])
        );

        return $user;
    }

      public static function findById($id)
    {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Utilisateur WHERE id LIKE '$id'")->fetch();

        $user = new UserEntity(
            $result['id'],
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


        $request = $db->prepare("INSERT INTO Utilisateur (email, nom, prenom, pseudo, mot_de_passe, valide, chaine_validation, id_role) VALUES (
            :email,
            :nom, 
            :prenom, 
            :pseudo, 
            :mot_de_passe, 
            :valide, 
            :chaine_validation, 
            :id_role)");

        $data = [
            'email' => $user->getEmail(),
            'nom' => $user->getLastName(),
            'prenom' => $user->getFirstName(),
            'pseudo' => $user->getAlias(),
            'mot_de_passe' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'valide' => $user->getValid() == true ? 1 : 0,
            'chaine_validation' => $user->getValidationString(),
            'id_role' => $user->getRole()->getId()
        ];

        $request->execute($data);
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

    public static function findByValidationString($validationString){
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Utilisateur WHERE chaine_validation LIKE '$validationString'")->fetch();

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

    public static function validateUser($email){
        $db = DataBaseService::getInstance()->getDb();
        $db->exec("UPDATE Utilisateur SET valide = true WHERE email = '$email'");
        $db->exec("UPDATE Utilisateur SET chaine_validation = '' WHERE email = '$email'");
        return;
    }


}