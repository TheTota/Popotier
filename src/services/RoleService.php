<?php

namespace Src\Services;

require_once 'src/services/DataBaseService.php';

require_once 'src/models/RoleEntity.php';

use Src\Models\RoleEntity;

class RoleService{

    public function fetchAll(){

    }

    public static function findById($id): RoleEntity{
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Role WHERE id = '$id'")->fetch();

        $role = new RoleEntity($result['id'], $result['libelle']);

        return $role;
    }

    public function add(RoleEntity $role){

    }

    public function update(RoleEntity $role){

    }

    public function delete(RoleEntity $role){

    }
}