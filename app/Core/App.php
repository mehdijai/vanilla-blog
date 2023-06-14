<?php

namespace App\Core;

use Closure;

class App
{
    protected static Container $container;

    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind(string $key, Closure $resolver)
    {
        static::$container->bind($key, $resolver);
    }

    public static function resolve(string $key)
    {
        return static::$container->resolve($key);
    }
}
