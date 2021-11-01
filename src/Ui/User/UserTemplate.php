<?php

namespace App\Ui\User;

use App\Manager\UserManager;
use App\Ui\Template;

class UserTemplate extends Template
{
    public function getCurrentUser(): ?\App\Entity\User
    {
        $manager = new UserManager();
        return $manager->getCurrentUser();
    }
}

