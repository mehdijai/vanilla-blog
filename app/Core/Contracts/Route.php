<?php

namespace App\Core\Contracts;

class Route
{
    public string $uri;
    public string | null $method = null;
    public string $controller;
    public string $closure = 'index';
    public array|null $middleware = null;

    public function __construct(string $uri, string | null $method = null, string $controller, string $closure = 'index', array|string|null $middleware = null)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->controller = $controller;
        $this->closure = $closure;
        $this->middleware = $middleware;
    }
}
