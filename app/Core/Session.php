<?php

namespace App\Core;

class Session
{
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
}
