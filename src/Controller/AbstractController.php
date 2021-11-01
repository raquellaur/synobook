<?php

namespace App\Controller;

abstract class AbstractController
{
    public function notFound()
    {
        header('HTTP/2.0 404 not fount');
        exit();
    }

    public function movedPermanently($url)
    {
        header("Status: 301 Moved Permanently", false, 301);
        header("Location: " . $url);
        exit();
    }

    public function internalRedirect($controller)
    {
        //redirect to another controller
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'
            ? 'https'
            : 'http';
        //$protocol = null;
        $url = sprintf(
            "%s://%s/%s",
            $protocol,
            $_SERVER['SERVER_NAME'],
            $controller
        );
        $this->movedPermanently($url);
    }

    abstract public function execute();
}
