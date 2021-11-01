<?php

namespace App\Controller;

use App\Manager\UserManager;
use App\Ui\Template;

class AddfriendController extends AbstractController implements ControllerInterface
{
    public function execute()
    {
        $displayForm = false;

        if (!array_key_exists('friends', $_POST)) {
            $displayForm = true;
        }

        if ($displayForm) {
            $template = new Template();

            $template->setTemplate('src/design/templates/user/list_friends.phtml');

            echo $template->render();
        } else {

            $friends = $_POST['friends'];

            $manager = new UserManager();
            $manager->login($username, $password);

            $this->internalRedirect('Customer');
        }
    }
}
