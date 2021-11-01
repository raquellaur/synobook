<?php

namespace App\Exception;

class ControllerException extends \Exception
{
    protected $message = "Ce controller n'existe pas";
}
