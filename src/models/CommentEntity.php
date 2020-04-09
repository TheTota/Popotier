<?php

namespace Src\Models;

use http\Client\Curl\User;

class CommentEntity{

    private $id;
    private $description;
    private $date;
    private $user;
    private $recipe;

    public function __construct($id, $date, $description, $recipe, $user)
    {
        $this->id = $id;
        $this->description = $description;
        $this->date = $date;
        $this->user = $user;
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
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return UserEntity
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }

    /**
     * @param UserEntity $user
     */
    public function setUser(UserEntity $user)
    {
        $this->user = $user;
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