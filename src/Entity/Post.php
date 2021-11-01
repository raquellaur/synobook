<?php

namespace App\Entity;

use DateTime;

class Post extends MutableEntity
{
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getDataWithKey('id');
    }

    public function setId(int $id): Post
    {
        $this->setDataWithKey('id', $id);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getDataWithKey('name');
    }

    public function setName(string $name): Post
    {
        $this->setDataWithKey('name', $name);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->getDataWithKey('content');
    }

    public function setContent(string $content): Post
    {
        $this->setDataWithKey('content', $content);

        return $this;
    }

    public function getCreatedAt(): datetime
    {
        $datetime = new DateTime();
        return $datetime::createFromFormat('Y-m-d H:i:s', $this->setDataWithKey('created_at'));
    }

    public function setCreatedAt(\DateTime $createdAt): Post
    {
        $updatedAt = $createdAt->format('Y-m-d H:i:s');
        $this->setDataWithKey('created_at', $createdAt);

        return $this;
    }

}
