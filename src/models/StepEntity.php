<?php

namespace Src\Models;

class StepEntity {

    private $id;
    private $position;
    private $description;
    private $recipe; // RecipeEntity

    /**
     * StepEntity constructor.
     * @param $id
     * @param $position
     * @param $description
     * @param $recipe
     */
    public function __construct($id, $position, $description, $recipe)
    {
        $this->id = $id;
        $this->position = $position;
        $this->description = $description;
        $this->recipe = $recipe;
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
     * @return integer
     */
    public function getPosition(): integer
    {
        return $this->position;
    }

    /**
     * @param integer $position
     */
    public function setPosition(integer $position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return RecipeEntity
     */
    public function getRecipe(): RecipeEntity
    {
        return $this->recipe;
    }

    /**
     * @param RecipeEntity $recipe
     */
    public function setRecipe(RecipeEntity $recipe)
    {
        $this->recipe = $recipe;
    }




}