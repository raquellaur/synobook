<?php

namespace App\System;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private static $instance;

    protected $config;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->config = Yaml::parseFile(__DIR__ . '/../../Config/app.yaml');
    }

    public function getFullConfig()
    {
        return $this->config;
    }

    public function getConfig(string $path, &$currentConfig = null)
    {
        if ($currentConfig == null) {
            $currentConfig = $this->config;
        }

        $pathParts = explode('/', $path);

        $part = array_shift($pathParts);

        if (isset($currentConfig[$part])) {
            $value = $currentConfig[$part];
        } else {
            return null;
        }

        if (is_array($value) && (count($pathParts) > 0)) {
            return $this->getConfig(implode('/', $pathParts), $value);
        } else {
            return $value;
        }
    }
}
