<?php

namespace src\services;

class DataBaseService { 

    private $hote; // Adresse du serveur 
    private $login; // Login 
    private $pass; // Mot de passe 
    private $dbName;
    private $db; // Base de données à utiliser 


	public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseManager();
        }

        return self::$instance;
    }

    public function __construct($hote,$login,$pass, $db, $dbName)
    {
        $this->hote = $hote;
        $this->login = $login;
        $this->pass = $pass;
        $this->db_name = $dbName;

    }

	public function connection() {
		try {
                $this->db = new PDO('mysql:host='.$this->hote.';dbname='.$this->dbName, $this->login, $this->pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

    
    function getDb() {
        return $this->db;
    }
}
   
