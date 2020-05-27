<?php

namespace src\models;

class RecipeEntity implements \JsonSerializable
{

    private $id;
    private $name;
    private $image;
    private $creationDate;
    private $cookingTime;
    private $preparationTime;
    private $personNumber;
    private $difficulty;
    private $meanPrice;
    private $authorQuote;
    private $valid;
    private $author; // UserEntity
    private $type; // TypeEntity
    private $admin; // UserEntity
    private $steps; // StepEntity[]
    private $ingredients; // IngredientRecipeEntity[]


    public function __construct(
        $id,
        $name,
        $image,
        $creationDate,
        $cookingTime,
        $preparationTime,
        $personNumber,
        $difficulty,
        $meanPrice,
        $authorQuote,
        $valid,
        $author,
        $type,
        $admin,
        $steps,
        $ingredients
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->creationDate = $creationDate;
        $this->cookingTime = $cookingTime;
        $this->preparationTime = $preparationTime;
        $this->personNumber = $personNumber;
        $this->difficulty = $difficulty;
        $this->meanPrice = $meanPrice;
        $this->authorQuote = $authorQuote;
        $this->valid = $valid;
        $this->author = $author;
        $this->type = $type;
        $this->admin = $admin;
        $this->steps = $steps;
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
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
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

    /**
     * @return UserEntity
     */
    public function getAuthor(): UserEntity
    {
        return $this->author;
    }

    /**
     * @param UserEntity $author
     */
    public function setAuthor(UserEntity $author)
    {
        $this->author = $author;
    }

    /**
     * @return RecipeTypeEntity
     */
    public function getType(): RecipeTypeEntity
    {
        return $this->type;
    }

    /**
     * @param RecipeTypeEntity $type
     */
    public function setType(RecipeTypeEntity $type)
    {
        $this->type = $type;
    }

    /**
     * @return UserEntity|null
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param UserEntity $admin
     */
    public function setAdmin(UserEntity $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return StepEntity[]
     */
    public function getSteps(): array
    {
        return $this->steps;
    }

    /**
     * @param StepEntity[] $steps
     */
    public function setSteps(array $steps)
    {
        $this->steps = $steps;
    }

    /**
     * @return IngredientRecipeEntity[]
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param IngredientRecipeEntity[] $ingredients
     */
    public function setIngredients(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "image" => $this->getImage(),
            "creationDate" => $this->getCreationDate(),
            "cookingTime" => $this->getCookingTime(),
            "preparationTime" => $this->getPreparationTime(),
            "personNumber" => $this->getPersonNumber(),
            "difficulty" => $this->getDifficulty(),
            "meanPrice" => $this->getMeanPrice(),
            "authorQuote" => $this->getAuthorQuote(),
            "author" => $this->getAuthor(),
            "type" => $this->getType(),
            "steps" => $this->getSteps(),
            "ingredients" => $this->getIngredients(),
        ];
    }
}