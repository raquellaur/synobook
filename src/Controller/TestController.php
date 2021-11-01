<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;

class TestController extends AbstractController implements ControllerInterface
{
    public function execute()
    {
        $manager = new PostRepository();
        $post = new Post();
        $post->setName('teste')
            ->setContent('teste')
            ->setCreatedAt(new \DateTime());


        $manager->save($post);


    }
}
