<?php

namespace App\Manager;

use App\Crypt\Encrypter;
use App\Entity\User;
use App\Repository\UserRepository;
use App\System\App;

class UserManager
{
    protected function getSessionManager(): ?SessionManager
    {
        return App::getInstance()->getSessionManager();
    }

    const SESSION_USER_KEY = 'current_user';

    public function isLoggedIn(): bool
    {
        return !is_null($this->getSessionManager()->get(self::SESSION_USER_KEY));
    }

    public function getCurrentUser(): ?User
    {
        if (!$this->isLoggedIn()) {
            return new User();
        }

        $id = $this->getSessionManager()->get(self::SESSION_USER_KEY);
        $repository = new UserRepository();

        return $repository->findById($id);
    }

    public function login($login, $password)
    {
        $encrypt = new Encrypter();

        $repository = new UserRepository();
        $user = $repository->findByLogin($login);

        if ($user && $user->getPassword() == $encrypt->encrypt($password)) {
            $this->getSessionManager()->add(self::SESSION_USER_KEY, $user->getId());
        }
    }

    public function logout()
    {
        $this->getSessionManager()->remove(self::SESSION_USER_KEY);
    }
}
