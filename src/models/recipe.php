<?php

class Recipe {

    private $id;
    private $name;
    private $image;
    private $cookingTime;
    private $preparationTime;
    private $personNumber;
    private $difficulty;
    private $meanPrice;
    private $evaluation;
    private $authorQuote;
    private $valid;

    public function __construct(
        $id,
        $name,
        $image,
        $cookingTime,
        $preparationTime,
        $personNumber,
        $difficulty,
        $meanPrice,
        $evaluation,
        $authorQuote,
        $valid)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->cookingTime = $cookingTime;
        $this->preparationTime = $preparationTime;
        $this->personNumber = $personNumber;
        $this->difficulty = $difficulty;
        $this->meanPrice = $meanPrice;
        $this->evaluation = $evaluation;
        $this->authorQuote = $authorQuote;
        $this->valid = $valid;
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
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * @param mixed $cookingTime
     */
    public function setCookingTime($cookingTime)
    {
        $this->cookingTime = $cookingTime;
    }

    /**
     * @return mixed
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * @param mixed $preparationTime
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;
    }

    /**
     * @return mixed
     */
    public function getPersonNumber()
    {
        return $this->personNumber;
    }

    /**
     * @param mixed $personNumber
     */
    public function setPersonNumber($personNumber)
    {
        $this->personNumber = $personNumber;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return mixed
     */
    public function getMeanPrice()
    {
        return $this->meanPrice;
    }

    /**
     * @param mixed $meanPrice
     */
    public function setMeanPrice($meanPrice)
    {
        $this->meanPrice = $meanPrice;
    }

    /**
     * @return mixed
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * @param mixed $evaluation
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * @return mixed
     */
    public function getAuthorQuote()
    {
        return $this->authorQuote;
    }

    /**
     * @param mixed $authorQuote
     */
    public function setAuthorQuote($authorQuote)
    {
        $this->authorQuote = $authorQuote;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }


}