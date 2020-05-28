<?php

namespace src\models;

class SeasonEntity{

    private $id;
    private $libelle;

    /**
     * SeasonEntity constructor.
     * @param $id
     * @param $label
     */
    public function __construct($id, $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $name
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }





}