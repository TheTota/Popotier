<?php

namespace src\models;

class StepEntity {

    private $id;
    private $position;
    private $description;

    /**
     * StepEntity constructor.
     * @param $id
     * @param $position
     * @param $description
     * @param $recipe
     */
    public function __construct($id, $position, $description)
    {
        $this->id = $id;
        $this->position = $position;
        $this->description = $description;
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
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position)
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
}