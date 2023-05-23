<?php

class Router
{
    private $method;
    private $uri;

    private static $instance = null;

    public function __construct()
    {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->uri = preg_replace("/(^\/)|(\/$)/", "", parse_url($_SERVER['REQUEST_URI'])['path']);
    }

    public function get($route, $controller, $function = "index")
    {
        $this->add('GET', $route, $controller, $function);
    }

    public function post($route, $controller, $function = "index")
    {
        $this->add('POST', $route, $controller, $function);
    }

    public function patch($route, $controller, $function = "index")
    {
        $this->add('PATCH', $route, $controller, $function);
    }

    public function put($route, $controller, $function = "index")
    {
        $this->add('PUT', $route, $controller, $function);
    }

    public function delete($route, $controller, $function = "index")
    {
        $this->add('DELETE', $route, $controller, $function);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }

        return self::$instance;
    }

    private function render($controller, $function, $data = [])
    {
        require("controllers/" . $controller . "Controller.php");
        $className = $controller . "Controller";
        $instance = new $className($data);
        extract($data);
        call_user_func(array($instance, $function));
        exit();
    }

    public function simpleRoute($route, $controller, $function)
    {

        if (!empty($this->uri)) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $this->uri);
        } else {
            $reqUri = "/";
        }

        parse_str($_SERVER['QUERY_STRING'], $queries);

        if ($reqUri == $route) {
            $this->render($controller, $function, compact('queries'));
        }
    }
    public function add($method, $route, $controller, $function)
    {
        if (!in_array($method, ['GET', 'POST', "PUT", "PATCH", "DELETE"])) {
            throw new \InvalidArgumentException("method is not correct");
        }

        if ($this->method != $method) {
            return;
        }

        $params = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);

        $paramKey = [];

        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        if (empty($paramMatches[0])) {
            $this->simpleRoute($route, $controller, $function);
            return;
        }

        foreach ($paramMatches[0] as $key) {
            $paramKey[] = $key;
        }

        if (!empty($this->uri)) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $this->uri);
        } else {
            $reqUri = "/";
        }

        $uri = explode("/", $route);

        $indexNum = [];

        foreach ($uri as $index => $param) {
            if (preg_match("/{.*}/", $param)) {
                $indexNum[] = $index;
            }
        }

        $reqUri = explode("/", $reqUri);

        foreach ($indexNum as $key => $index) {

            if (empty($reqUri[$index])) {
                return;
            }

            $params[$paramKey[$key]] = $reqUri[$index];

            $reqUri[$index] = "{.*}";
        }

        $reqUri = implode("/", $reqUri);

        $reqUri = str_replace("/", '\\/', $reqUri);

        if (preg_match("/$reqUri/", $route)) {
            $this->render($controller, $function, compact('queries', 'params'));
            exit();
        }

        abort(404);
    }
}
