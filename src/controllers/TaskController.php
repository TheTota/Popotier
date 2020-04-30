<?php

namespace src\controllers;

use src\services\DataBaseService;

class TaskController{

    /**
     * Delete all user that who did not validate their account from a period since creation
     */
    public function deleteUnvalidUsers(){
        $db = DataBaseService::getInstance()->getDb();

        $db->exec("DELETE FROM Utilisateur WHERE valide = 0 AND date_creation + INTERVAL 30 MINUTE < CURRENT_TIMESTAMP");
    }
}