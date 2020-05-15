<?php

namespace src\models;

class RecipeTypeEntity implements \JsonSerializable {

    private $id;
    private $label;

    /**
     * RecipeTypeEntity constructor.
     * @param $id
     * @param $label
     */
    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "label" => $this->getLabel()
        ];
    }
}