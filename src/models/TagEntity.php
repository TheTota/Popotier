<?php

namespace Src\Models;

class TagEntity{

    private $id;
    private $label;

    /**
     * TagEntity constructor.
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
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }


}