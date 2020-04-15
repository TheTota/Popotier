<?php

namespace Src\Models;

class IngredientEntity{

    private $id;
    private $name;
    private $allergen; // AllergenEntity

    /**
     * IngredientEntity constructor.
     * @param $id
     * @param $name
     * @param null|AllergenEntity $allergen
     */
    public function __construct($id, $name, $allergen)
    {
        $this->id = $id;
        $this->name = $name;
        $this->allergen = $allergen;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null|AllergenEntity
     */
    public function getAllergen()
    {
        return $this->allergen;
    }

    /**
     * @param AllergenEntity $allergen
     */
    public function setAllergen(AllergenEntity $allergen)
    {
        $this->allergen = $allergen;
    }





}