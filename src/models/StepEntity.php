<?php

namespace Src\Models;

class StepEntity {

    private $id;
    private $position;
    private $description;
    private $recipe;

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
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;
    }




}