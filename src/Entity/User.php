<?php

namespace App\Entity;

use App\Crypt\Encrypter;
use DateTime;

class User extends MutableEntity
{
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getDataWithKey('id');
    }

    public function setId(int $id): User
    {
        $this->setDataWithKey('id', $id);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->getDataWithKey('firstname');
    }

    public function setFirstname(string $firstname): User
    {
        $this->setDataWithKey('firstname', $firstname);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->getDataWithKey('lastname');
    }

    public function setLastname(string $lastname): User
    {
        $this->setDataWithKey('lastname', $lastname);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->getDataWithKey('password');
    }

    public function setPassword(string $password): User
    {
        $encrypt = new Encrypter();
        $password = $encrypt->encrypt($password);
        $this->setDataWithKey('password', $password);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->getDataWithKey('login');
    }

    public function setLogin(string $login): User
    {
        $this->setDataWithKey('login', $login);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->getDataWithKey('email');
    }

    public function setEmail(string $email): User
    {
        $this->setDataWithKey('email', $email);

        return $this;
    }

    public function getCreatedAt(): datetime
    {
        $datetime = new DateTime();
        return $datetime::createFromFormat('Y-m-d H:i:s', $this->setDataWithKey('created_at'));
    }

    public function setCreatedAt(\DateTime $createdAt): User
    {
        $updatedAt = $createdAt->format('Y-m-d H:i:s');
        $this->setDataWithKey('created_at', $createdAt);

        return $this;
    }

    public function getUpdatedAt(): datetime
    {
        $datetime = new DateTime();
        return $datetime::createFromFormat('Y-m-d H:i:s', $this->setDataWithKey('updated_at'));
    }

    public function setUpdated(\DateTime $updatedAt): User
    {
        $updatedAt = $updatedAt->format('Y-m-d H:i:s');
        $this->setDataWithKey('updated_at', $updatedAt);

        return $this;
    }
}
