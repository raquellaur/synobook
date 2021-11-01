<?php

namespace App\Repository;

use App\Entity\User;
use App\System\App;

class UserRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = App::getInstance()->getConnection();
    }

    public function findById(int $id): ?User
    {
        return $this->findBy('id', $id);
    }

    public function save(User $user)
    {
        $found = false;
        if ($user->getId()) {
            $found = $this->findById($user->getId());
        }


        $dateToProcess = $user->getData();
        unset($dateToProcess['id']);
        unset($dateToProcess['type']);


        if ($found) {
            //update
            $dataToUpdate = [];
            foreach ($dateToProcess as $key => $value) {
                $dataToUpdate[] = $key . '=:' . $key;
            }
            $request = "UPDATE user SET " . implode(',', $dataToUpdate) . " WHERE id = :id";

            $dateToProcess['id'] = $user->getId();
        } else {
            $dataToInsert = [];

            foreach ($dateToProcess as $key => $value) {
                $dataToInsert[$key] = ':' . $key;
            }

            $dataToInsert['created_at'] = ':created_at';
            $dataToInsert['updated_at'] = ':updated_at';

            $dateToProcess['created_at'] = date('Y-m-d H:i:s');
            $dateToProcess['updated_at'] = date('Y-m-d H:i:s');

            $request = 'INSERT INTO user (' . implode(',', array_keys($dataToInsert));
            $request.= ") VALUES (" . implode(',', $dataToInsert) . ")";
        }

        return $this->connection->request($request, $dateToProcess, false);
    }

    public function deleteById(int $id): ?User
    {
        $result = $this->connection->request(
            "DELETE * FROM user WHERE id=:id",
            ['id' => $id]
        );
        if (!sizeof($result)) {
            return null;
        }
        $user = new User();
        $user->setData(array_shift($result));

        return $user;
    }

    public function findBy($field, $value): ?User
    {
        $result = $this->connection->request(
            "SELECT * FROM user WHERE `$field` = :value",
            ['value' => $value]
        );
        if (!sizeof($result)) {
            return null;
        }

        $user = new User();
        $user->setData(array_shift($result));

        return $user;
    }


    public function findByLogin(string $login): ?User
    {
        return $this->findBy('login', $login);
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'user';
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return User::class;
    }
}
