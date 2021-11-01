<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

class TestController extends AbstractController implements ControllerInterface
{
    public function execute()
    {
        $manager = new UserRepository();
        $user = new User();
        $user->setFirstname('teste')
            ->setPassword('teste')
            ->setLogin('teste')
            ->setLastname('teste')
            ->setCreatedAt(new \DateTime())
            ->setUpdated(new \DateTime());

        $manager->save($user);


    }
}
