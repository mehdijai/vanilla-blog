<?php

namespace App\Core\Middleware;

use Exception;

class Middleware
{

    private static $middlewares = [
        'guest' => GuestMiddleware::class,
        'auth' => AuthMiddleware::class,
    ];

    public static function resolve(string $key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::$middlewares[$key] ?? null;


        if (!$middleware) {
            throw new Exception("There is no matching middleware for key '{$key}'.");
        }

        (new $middleware)->handle();
    }

    public static function resolveMultiple(array $keys)
    {
        foreach ($keys as $key) {
            static::resolve($key);
        }
    }
}
