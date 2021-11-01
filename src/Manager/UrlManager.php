<?php

namespace App\Manager;

class UrlManager
{
    protected static $instance;

    public static function getInstance(): UrlManager
    {
        if (is_null(self::$instance)) {
            self::$instance = new UrlManager();
        }
        return self::$instance;
    }

    public function getControllerName(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $url);
        array_shift($parts);
        $name = array_shift($parts);
        return $name;
    }

    public function getParams(): array
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($parts);
        array_shift($parts);
        $parameterData = array_chunk($parts, 2);

        $result = [];
        foreach ($parameterData as $data) {
            $result[$data[0]] = $data[1];
        }

        return $result;
    }

    public function getParam($key)
    {
        $params = $this->getParams();
        if (!array_key_exists($key, $params)) {
            return null;
        }

        return $params[$key];
    }


}
