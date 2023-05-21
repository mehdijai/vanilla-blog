<?php

// namespace App\Services;

// use InvalidArgumentException;

class Router
{
    private $url;
    private $query = null;
    private $method;

    private static $instance = null;

    private $routes = [];

    public function __construct()
    {
        $parsed = parse_url($_SERVER["REQUEST_URI"]);
        $this->url = $parsed["path"];
        if(key_exists('query', $parsed)){
            $this->query = $parsed["query"];
        }
        $this->method = $_SERVER["REQUEST_METHOD"];
    }

    public function get($route, $controller)
    {
        $this->add_request('GET', $route, $controller);
    }

    public function post($route, $controller)
    {
        $this->add_request('POST', $route, $controller);
    }

    public function patch($route, $controller)
    {
        $this->add_request('PATCH', $route, $controller);
    }

    public function put($route, $controller)
    {
        $this->add_request('PUT', $route, $controller);
    }

    public function delete($route, $controller)
    {
        $this->add_request('DELETE', $route, $controller);
    }

    private function add_request($method, $route, $controller)
    {
        if (!in_array($method, ['GET', 'POST', "PUT", "PATCH", "DELETE"])) {
            throw new \InvalidArgumentException("method is not correct");
        }

        array_push($this->routes, [
            'method' => $method,
            "route" => $route,
            "controller" => $controller,
        ]);
    }

    public function handle()
    {
        foreach ($this->routes as $route) {
            if ($this->method == $route["method"] && $this->url == $route['route']) {
                require("controllers/" . $route['controller'] . "Controller.php");
                return;
            }
        }
        abort(404);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }

        return self::$instance;
    }
}
