<?php

namespace App\Controller;

use App\Manager\UserManager;
use App\Ui\User\UserTemplate;

class CustomerController extends AbstractController implements ControllerInterface
{
    public function execute()
    {

        $manager = new UserManager();
        $user = $manager->getCurrentUser();

        if (!$user->getId()) {
            $this->internalRedirect('Login');
        }

        $template = new UserTemplate();

        $template->setTemplate('src/design/templates/user/profile.phtml');

        echo $template->render();
    }
}
