<?php

namespace Src\Models;

class RecipeEntity {

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
    private $author; // UserEntity
    private $type; // Type
    private $ingredients; // IngredientEntity


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
        $valid,
        $author,
        $type,
        $ingredients
    )
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
        $this->author = $author;
        $this->type = $type;
        $this->ingredients = $ingredients;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * @param int $cookingTime
     */
    public function setCookingTime($cookingTime)
    {
        $this->cookingTime = $cookingTime;
    }

    /**
     * @return int
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * @param int $preparationTime
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;
    }

    /**
     * @return int
     */
    public function getPersonNumber()
    {
        return $this->personNumber;
    }

    /**
     * @param int $personNumber
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
     * @return int
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * @param int $evaluation
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * @return string
     */
    public function getAuthorQuote()
    {
        return $this->authorQuote;
    }

    /**
     * @param string $authorQuote
     */
    public function setAuthorQuote($authorQuote)
    {
        $this->authorQuote = $authorQuote;
    }

    /**
     * @return boolean
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param boolean $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }


}