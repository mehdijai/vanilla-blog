<?php

namespace App\Core;

use App\Core\Contracts\Route;
use App\Core\Contracts\RouteCollection;
use App\Core\Middleware\Middleware;

class Router
{
    private static $instance = null;
    private RouteCollection | null $routes = null;
    private array $data = [];

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }

        return self::$instance;
    }

    private function add(Route $route)
    {
        if ($this->routes == null) {
            $this->routes = new RouteCollection([]);
        }

        $this->routes->append($route);
        return $this;
    }

    public function get($uri, $controller, $closure = 'index')
    {
        return $this->add(new Route($uri, 'GET', $controller, $closure));
    }

    public function post($uri, $controller, $closure = 'index')
    {
        return $this->add(new Route($uri, 'POST', $controller, $closure));
    }

    public function patch($uri, $controller, $closure = 'index')
    {
        return $this->add(new Route($uri, 'PATCH', $controller, $closure));
    }

    public function put($uri, $controller, $closure = 'index')
    {
        return $this->add(new Route($uri, 'PUT', $controller, $closure));
    }

    public function delete($uri, $controller, $closure = 'index')
    {
        return $this->add(new Route($uri, 'DELETE', $controller, $closure));
    }

    public function middleware(array $keys)
    {
        $this->routes->offsetGet($this->routes->count() - 1)->middleware = $keys;
    }

    private function render(string $controller, string $closure, array $data = [])
    {
        if (count($this->data) > 0) {
            $data = $this->data;
        }

        $instance = new $controller($data);
        call_user_func(array($instance, $closure));
    }

    public function route()
    {
        foreach ($this->routes as $route) {
            if ($this->matchRoutes($route)) {
                if ($route->middleware !=  null) {
                    Middleware::resolveMultiple($route->middleware);
                }
                $this->render($route->controller, $route->closure);
                exit();
            }
        }
        abort(404);
    }

    private function matchSimpleRoute(Route $route, string $server_uri, string $server_method): bool
    {
        $routeUri = $route->uri;

        if (!empty($server_uri)) {
            $routeUri = preg_replace("/(^\/)|(\/$)/", "", $route->uri);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $server_uri);
        } else {
            $reqUri = "/";
        }

        return $reqUri == $routeUri && $route->method == $server_method;
    }

    private function matchRoutes(Route $route): bool
    {
        $server_method = strtoupper($_POST['_method'] ?? $_SERVER["REQUEST_METHOD"]);

        if ($route->method != $server_method) {
            return false;
        }

        $server_uri = preg_replace("/(^\/)|(\/$)/", "", parse_url($_SERVER['REQUEST_URI'])['path']);
        parse_str($_SERVER['QUERY_STRING'], $queries);


        $params = [];
        $paramKey = [];

        preg_match_all("/(?<={).+?(?=})/", $route->uri, $paramMatches);


        if (empty($paramMatches[0])) {
            $this->data = compact("queries");
            return $this->matchSimpleRoute($route, $server_uri, $server_method);
        }

        foreach ($paramMatches[0] as $key) {
            $paramKey[] = $key;
        }

        if (!empty($server_uri)) {
            $routeUri = preg_replace("/(^\/)|(\/$)/", "", $route->uri);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $server_uri);
        } else {
            $reqUri = "/";
        }

        $uri = explode("/", $routeUri);

        $indexNum = [];

        foreach ($uri as $index => $param) {
            if (preg_match("/{.*}/", $param)) {
                $indexNum[] = $index;
            }
        }

        $reqUri = explode("/", $reqUri);

        foreach ($indexNum as $key => $index) {

            if (empty($reqUri[$index])) {
                return false;
            }

            $params[$paramKey[$key]] = $reqUri[$index];

            $reqUri[$index] = "{.*}";
        }

        $reqUri = implode("/", $reqUri);

        $reqUri = str_replace("/", '\\/', $reqUri);

        if (preg_match("/$reqUri/", $routeUri)) {
            $this->data = compact("queries", "params");
            return true;
        }

        return false;
    }
}
