<?php

namespace Src\Models;

class IngredientEntity{

    private $name;
    private $allergen;

    /**
     * IngredientEntity constructor.
     * @param $name
     */
    public function __construct($name, $allergen)
    {
        $this->name = $name;
        $this->allergen = $allergen;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
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