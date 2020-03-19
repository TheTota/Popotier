<?php

namespace Src\Services;

class DataBaseService { 

    private $hote = 'mysql-popotier.alwaysdata.net'; // Adresse du serveur
    private $login = 'popotier'; // Login
    private $pass = 'nopass@2020'; // Mot de passe
    private $dbName = 'popotier_bdd'; // Nom de la bdd

    private static $instance;

	public static function getInstance(): DataBaseService
    {
        if (self::$instance === null) {
            self::$instance = new DataBaseService();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->connection();
    }

	private function connection() {
		try {
                $this->db = new \PDO('mysql:host='.$this->hote.';dbname='.$this->dbName, $this->login, $this->pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

    function getDb(): \PDO {
        return $this->db;
    }
}
   
