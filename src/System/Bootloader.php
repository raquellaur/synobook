<?php

namespace App\System;

use App\Exception\ControllerException;

class Bootloader
{
    /**
     * @static
     */
    private static $instance;

    /**
     * @param void
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @param void
     * @return Bootloader
     */
    public static function getInstance(): ?Bootloader
    {
        if (is_null(self::$instance)) {
            self::$instance = new Bootloader();
        }

        return self::$instance;
    }
    public function run()
    {
        $controller = new ControllerManager();
        try {
            $controller->getController()->execute();
        } catch (ControllerException $exception) {
            header('HTTP/2.0 404 NotFound');
            exit;
        }
    }
}
