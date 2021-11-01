<?php

namespace App\Controller;

use App\Entity\Post;
use App\Manager\UserManager;
use App\Repository\PostRepository;
use App\Ui\Template;

class PostController extends AbstractController implements ControllerInterface
{
    public function execute()
    {
        $manager = new UserManager();

        if (!$manager->isLoggedIn()) {
            $this->internalRedirect('Login');
        }
        $displayForm = false;
        if (!array_key_exists('name', $_POST) && !array_key_exists('content', $_POST)) {
            $displayForm = true;
        }
        if ($displayForm) {
            $template = new Template();
            $template->setTemplate('src/design/templates/post/add_post.phtml');
            echo $template->render();
        } else {
            var_dump($_POST);
            $name = $_POST['name'];
            $content = $_POST['content'];
            $repository = new PostRepository();
            $post = new Post();
            $post->setName($name)
                ->setContent($content);
            $repository->save($post);
            $this->internalRedirect('List');

        }

    }
}
