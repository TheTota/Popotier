<?php

namespace src\models;

use Src\Models\RoleEntity;

class UserEntity
{
    private $id;
    private $email;
    private $lastName;
    private $firstName;
    private $alias;
    private $password;
    private $valid;
    private $validationString;
    private $role; // Role Entity

    public function __construct(
        $id,
        $email,
        $lastName,
        $firstName,
        $alias,
        $password,
        $role,
        $validationString = ''
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->alias = $alias;
        $this->password = $password;
        $this->valid = false;
        $this->validationString = $validationString;
        $this->role = $role;
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
    public function getValidationString(): string
    {
        return $this->validationString;
    }

    /**
     * @param string $validationString
     */
    public function setValidationString(string $validationString)
    {
        $this->validationString = $validationString;
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

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return RoleEntity
     */
    public function getRole(): RoleEntity
    {
        return $this->role;
    }

    /**
     * @param RoleEntity $role
     */
    public function setRole(RoleEntity $role)
    {
        $this->role = $role;
    }



}

