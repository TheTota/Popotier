<?php

namespace src\services;

use src\models\UnitEntity;

class UnitService {

    public static function findById($idUnit) {
        $db = DataBaseService::getInstance()->getDb();

        $unit = $db->query("SELECT * FROM Unite WHERE id = '$idUnit'")->fetch();

        return new UnitEntity(
            $unit['id'],
            $unit['nom']
        );
    }
}