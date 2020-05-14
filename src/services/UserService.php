<?php

namespace src\services;

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

        if ($result == false) {
            return false;
        } else {
            $user = new UserEntity(
                $result['id'],
                $result['email'],
                $result['nom'],
                $result['prenom'],
                $result['pseudo'],
                $result['mot_de_passe'],
                RoleService::findById($result['id_role']),
                $result['valide']
            );

            return $user;
        }
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

    public static function resetPassword($password, $validationString) {
        $db = DataBaseService::getInstance()->getDb();

        $newPassword = password_hash($password, PASSWORD_DEFAULT);
        $db->exec("UPDATE Utilisateur SET mot_de_passe = '$newPassword' WHERE chaine_validation = '$validationString'"); // set new pwd
        $db->exec("UPDATE Utilisateur SET chaine_validation = '' WHERE chaine_validation = '$validationString'"); // set chaine_validation to blank
        return;
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

    public static function addValidationString($userId, $validationString)
    {
        $db = DataBaseService::getInstance()->getDb();

        $db->exec("UPDATE Utilisateur SET chaine_validation = '$validationString' WHERE id = '$userId'");
        return;
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

        if ($result == false) {
            return false;
        } else {
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
    }

    public static function validateUser($email){
        $db = DataBaseService::getInstance()->getDb();
        $db->exec("UPDATE Utilisateur SET valide = true WHERE email = '$email'");
        $db->exec("UPDATE Utilisateur SET chaine_validation = '' WHERE email = '$email'");
        return;
    }

    public static function userValidated($email) {
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT valide from Utilisateur WHERE email = '$email'")->fetch();

        if($result && $result[0] == '1'){
            return true;
        } else {
            return false;
        }
    }

}