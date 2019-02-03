<?php

namespace Moofik\Framework\Http;

class Session
{
    private const FLASH = 'flash';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function set(string $name, string $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        return $_SESSION[$name] ?? $default;
    }


    /*
     * @return array
     */
    public function getFlashData(): array
    {
        if (isset($_SESSION[self::FLASH])) {
            $flashData = $_SESSION[self::FLASH];
            unset($_SESSION[self::FLASH]);

            return $flashData;
        }

        return [];
    }


    /**
     * @param array $arr
     */
    public function setFlashData(array $arr)
    {
        foreach ($arr as $variable => $value) {
            $_SESSION[self::FLASH][$variable] = $value;
        }
    }

    /**
     * @param string $name
     */
    public function unset(string $name)
    {
        unset($_SESSION[$name]);
    }
}