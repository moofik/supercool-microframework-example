<?php

namespace Moofik\Framework\Http;

class Request
{
    /**
     * @param string $param
     * @param null $default
     * @return mixed
     */
    public function get(string $param, $default = null)
    {
        if (isset($_REQUEST[$param])) {
            return $_REQUEST[$param];
        }

        if (isset($_GET[$param])) {
            return $_GET[$param];
        }

        if (isset($_POST[$param])) {
            return $_POST[$param];
        }

        return $default;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}