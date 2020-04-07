<?php

namespace Src\Models;

class IngredientEntity{

    private $id;
    private $name;

    /**
     * IngredientEntity constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->name;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $name)
    {
        $this->name = $name;
    }




}