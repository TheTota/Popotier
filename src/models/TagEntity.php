<?php

namespace Src\Models;

class TagEntity{

    private $id;
    private $name;

    /**
     * TagEntity constructor.
     * @param $id
     * @param $label
     */
    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->name = $label;
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





}