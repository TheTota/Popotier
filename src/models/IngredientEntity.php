<?php

namespace Src\Models;

class IngredientEntity{

    private $id;
    private $name;
    private $quantity;
    private $allergen; // AllergenEntity

    /**
     * IngredientEntity constructor.
     * @param $id
     * @param $name
     * @param null|AllergenEntity $allergen
     */
    public function __construct($id, $name, $quantity = null, $allergen)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
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
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
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