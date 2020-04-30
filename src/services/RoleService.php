<?php

namespace src\services;

require_once 'src/services/DataBaseService.php';

require_once 'src/models/RoleEntity.php';

use src\models\RoleEntity;

class RoleService{

    public function fetchAll(){

    }

    public static function findById($id): RoleEntity{
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Role WHERE id = '$id'")->fetch();

        $role = new RoleEntity($result['id'], $result['libelle']);

        return $role;
    }

    public static function findByName($name): RoleEntity{
        $db = DataBaseService::getInstance()->getDb();

        $result = $db->query("SELECT * FROM Role WHERE libelle = '$name'")->fetch();

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