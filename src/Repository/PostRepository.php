<?php

namespace App\Repository;

use App\Entity\Post;
use App\Manager\UserManager;
use App\System\App;

class PostRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = App::getInstance()->getConnection();
    }

    public function findById(int $id)
    {
        return $this->findBy('id', $id);
    }

    public function save(Post $post)
    {
        $found = false;
        if ($post->getId()) {
            $found = $this->findById($post->getId());
        }

        $dateToProcess = $post->getData();
        unset($dateToProcess['id']);
        unset($dateToProcess['type']);


        if ($found) {
            $dataToUpdate = [];
            foreach ($dateToProcess as $key => $value) {
                $dataToUpdate[] = $key . '=:' . $key;
            }
            $request = "UPDATE post SET " . implode(',', $dataToUpdate) . " WHERE id = :id";

            $dateToProcess['id'] = $post->getId();
        } else {
            $dataToInsert = [];

            foreach ($dateToProcess as $key => $value) {
                $dataToInsert[$key] = ':' . $key;
            }
            $dataToInsert['created_at'] = ':created_at';
            $dateToProcess['created_at'] = date('Y-m-d H:i:s');

            $manager = new UserManager();
            $user = $manager->getCurrentUser();

            $dataToInsert['user_id'] = ':user_id';
            $dateToProcess['user_id'] = $user->getId();


            $request = 'INSERT INTO post (' . implode(',', array_keys($dataToInsert));
            $request .= ") VALUES (" . implode(',', $dataToInsert) . ")";
        }

        return $this->connection->request($request, $dateToProcess, false);
    }

    public function deleteById(int $id): ?Post
    {
        $result = $this->connection->request(
            "DELETE FROM post WHERE id=:id",
            ['id' => $id]
        );
        if (!sizeof($result)) {
            return null;
        }
        $post = new Post();
        $post->setData(array_shift($result));

        return $post;
    }

    public function findBy($field, $value): ?Post
    {
        $result = $this->connection->request(
            "SELECT * FROM post WHERE `$field` = :value",
            ['value' => $value]
        );
        if (!sizeof($result)) {
            return null;
        }

        $post = new Post();
        $post->setData(array_shift($result));

        return $post;
    }

    public function findAll()
    {
        $manager = new UserManager();
        $user = $manager->getCurrentUser();
        $userId = $user->getId();
        $result = $this->connection->request(
            "SELECT * FROM post WHERE id_user = :value",
            ['value' => $userId]
        );
        if (!sizeof($result)) {
            return [];
        }
        $posts = [];
        foreach ($result as $data) {
            $post = new Post();
            $post->setData($data);
            $posts[] = $post;
        }

        return $posts;
    }

    /**
     * @param string $search
     * @return array|string
     */
        public function searchPost(string $search)
    {
        $request = 'select * from post where name like "%' . $search . '%"';
        echo $request;
        $result = $this->connection->request($request);

        if (!sizeof($result)) {
            return [];
        }

        $entities = [];

        foreach ($result as $data) {
            $entityType = $this->getEntityType();
            $entity = new $entityType();
            $entity->setData($data);
            $entities[] = $entity;
        }

        return $entities;
    }
}
