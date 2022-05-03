<?php

namespace Papajik\AresSearch;

abstract class Http
{

    /**
     * Method to determine if secure protocol is used
     * @return bool
     */
    static function isSecure(): bool
    {
        return
            (!empty($_SERVER['HTTPS']) && filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN))
            || $_SERVER['SERVER_PORT'] == 443;
    }
}