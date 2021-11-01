<?php

namespace App\System;

use App\Controller\ControllerInterface;
use App\Exception\ControllerException;
use App\Manager\UrlManager;

class ControllerManager
{
    /**
     * @throws ControllerException
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        $urlManager = UrlManager::getInstance();
        $controllerName = $urlManager->getControllerName();
        if (empty($controllerName)) {
            $controllerName = 'Default';
        }
        $controllerClass = 'App\\Controller\\' . $controllerName . 'Controller';

        if (!class_exists($controllerClass)) {
            throw new ControllerException();
        }

        return new $controllerClass;
    }
}
