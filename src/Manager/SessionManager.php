<?php

namespace App\Manager;

class SessionManager
{
    private static $instance = null;

    const SESSION_KEY = 'APP_SESSION';

    protected $data = [];

    public static function getInstance(): ?SessionManager
    {
        if (is_null(self::$instance)) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    private function __construct()
    {
        session_start();
        if (array_key_exists(self::SESSION_KEY, $_SESSION)) {
            $this->data = \json_decode(($_SESSION[self::SESSION_KEY]), true);
            return;
        }
        $this->data = [];
    }

    public function add($key, $value): SessionManager
    {
        $this->data[$key] = $value;
        $this->persistSection();
        return $this;
    }

    public function remove(string $key): SessionManager
    {
        if (array_key_exists($key, $this->data)) {
            unset($this->data[$key]);
        }
        $this->persistSection();
        return $this;
    }

    public function get(string $key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }

    public function persistSection()
    {
        $_SESSION[self::SESSION_KEY] = \json_encode($this->data);
    }
}
