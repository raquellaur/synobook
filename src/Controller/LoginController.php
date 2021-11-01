<?php

namespace App\Controller;

use App\Manager\UserManager;
use App\Ui\Template;

class LoginController extends AbstractController implements ControllerInterface
{
    public function execute()
    {
        $displayForm = false;

        if ((!array_key_exists('username', $_POST)) && (!array_key_exists('password', $_POST))) {
            $displayForm = true;
        }

        if ($displayForm) {
            $template = new Template();

            $template->setTemplate('src/design/templates/user/login.phtml');

            echo $template->render();
        } else {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $manager = new UserManager();
            $manager->login($username, $password);

            $this->internalRedirect('Customer');
        }
    }
}
