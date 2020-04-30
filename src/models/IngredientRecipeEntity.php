<?php

namespace src\models;

/**
 * Class IngredientRecipeEntity
 * @package Src\Models
 * This entity is used for ingredients attached to a recipe.
 * To display a list of ingredients IngredientEntity should be used.
 */
class IngredientRecipeEntity {

    private $ingredient; //IngredientEntity
    private $quantity;
    private $unit; // UnitEntity

    /**
     * IngredientRecipeEntity constructor.
     * @param $ingredient IngredientEntity
     * @param $quantity
     * @param $unit UnitEntity
     */
    public function __construct($ingredient, $quantity, $unit)
    {
        $this->ingredient = $ingredient;
        $this->quantity = $quantity;
        $this->unit = $unit;
    }

    /**
     * @return IngredientEntity
     */
    public function getIngredient(): IngredientEntity
    {
        return $this->ingredient;
    }

    /**
     * @param IngredientEntity $ingredient
     */
    public function setIngredient(IngredientEntity $ingredient)
    {
        $this->ingredient = $ingredient;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return UnitEntity
     */
    public function getUnit(): UnitEntity
    {
        return $this->unit;
    }

    /**
     * @param UnitEntity $unit
     */
    public function setUnit(UnitEntity $unit)
    {
        $this->unit = $unit;
    }
}