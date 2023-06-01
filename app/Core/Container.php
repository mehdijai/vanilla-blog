<?php

namespace App\Core;

use Closure;
use Exception;

class Container
{
    protected $bindings = [];
    public function bind(string $key, Closure $resolver)
    {
        $this->bindings[$key] = $resolver;
    }
    public function resolve(string $key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching found for {$key}");
        }

        return call_user_func($this->bindings[$key]);
    }
}
