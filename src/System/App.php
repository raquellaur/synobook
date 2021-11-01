<?php

namespace App\System;

use App\Manager\SessionManager;
use App\Mysql\Connection;

class App
{
    private static $instance;

    private $connection;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    public function getConfig(): Config
    {
        return Config::getInstance();
    }

    public function getConnection()
    {
        if (!$this->connection) {
            $this->connection = new Connection(
                $this->getConfig()->getConfig('db/host'),
                $this->getConfig()->getConfig('db/user'),
                $this->getConfig()->getConfig('db/password'),
                $this->getConfig()->getConfig('db/database'),
                $this->getConfig()->getConfig('db/port'),
            );
        }

        return $this->connection;
    }

    public function getSessionManager(): ?SessionManager
    {
        return SessionManager::getInstance();
    }
}
