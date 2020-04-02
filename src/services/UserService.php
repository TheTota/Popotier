<?php

namespace Src\Services;

require_once 'src/models/UserEntity.php';

require_once 'src/services/RoleService.php';

use Src\Models\RoleEntity;
use Src\Models\UserEntity;

class UserService
{

    public function fetchAll() {

    }

    public static function findByEmail($email) {
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

    public function add(UserEntity $user)
    {

    }

    public function update(UserEntity $user)
    {

    }

    public function delete(UserEntity $user){

    }


}