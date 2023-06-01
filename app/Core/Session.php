<?php

namespace App\Core;

class Session
{
    public static function set(string $key, string $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get(string $key): string | null
    {
        return $_SESSION[$key] ?? null;
    }
}
