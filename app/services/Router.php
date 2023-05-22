<?php

// namespace App\Services;

// use InvalidArgumentException;

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

    public function get($route, $controller)
    {
        $this->add('GET', $route, $controller);
    }

    public function post($route, $controller)
    {
        $this->add('POST', $route, $controller);
    }

    public function patch($route, $controller)
    {
        $this->add('PATCH', $route, $controller);
    }

    public function put($route, $controller)
    {
        $this->add('PUT', $route, $controller);
    }

    public function delete($route, $controller)
    {
        $this->add('DELETE', $route, $controller);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }

        return self::$instance;
    }

    public function simpleRoute($route, $controller)
    {
        if (!empty($uri)) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $this->uri);
        } else {
            $reqUri = "/";
        }

        if ($reqUri == $route) {
            $params = [];
            parse_str($_SERVER['QUERY_STRING'], $queries);
            require("controllers/" . $controller . "Controller.php");
            exit();
        }
    }
    public function add($method, $route, $controller)
    {
        if (!in_array($method, ['GET', 'POST', "PUT", "PATCH", "DELETE"])) {
            throw new \InvalidArgumentException("method is not correct");
        }

        if ($this->method != $method) {
            return;
        }
        //will store all the parameters value in this array
        $params = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);

        //will store all the parameters names in this array
        $paramKey = [];

        //finding if there is any {?} parameter in $route
        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        //if the $route does not contain any param call simpleRoute();
        if (empty($paramMatches[0])) {
            $this->simpleRoute($route, $controller);
            return;
        }

        //setting parameters names
        foreach ($paramMatches[0] as $key) {
            $paramKey[] = $key;
        }

        //replacing first and last forward slashes
        //$_SERVER['REQUEST_URI'] will be empty if req uri is /

        if (!empty($this->uri)) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $this->uri);
        } else {
            $reqUri = "/";
        }


        //exploding route address
        $uri = explode("/", $route);

        //will store index number where {?} parameter is required in the $route 
        $indexNum = [];

        //storing index number, where {?} parameter is required with the help of regex
        foreach ($uri as $index => $param) {
            if (preg_match("/{.*}/", $param)) {
                $indexNum[] = $index;
            }
        }

        //exploding request uri string to array to get
        //the exact index number value of parameter from $_SERVER['REQUEST_URI']
        $reqUri = explode("/", $reqUri);

        //running for each loop to set the exact index number with reg expression
        //this will help in matching route
        foreach ($indexNum as $key => $index) {

            //in case if req uri with param index is empty then return
            //because url is not valid for this route
            if (empty($reqUri[$index])) {
                return;
            }

            //setting params with params names
            $params[$paramKey[$key]] = $reqUri[$index];

            //this is to create a regex for comparing route address
            $reqUri[$index] = "{.*}";
        }

        //converting array to sting
        $reqUri = implode("/", $reqUri);

        //replace all / with \/ for reg expression
        //regex to match route is ready !
        $reqUri = str_replace("/", '\\/', $reqUri);

        //now matching route with regex
        if (preg_match("/$reqUri/", $route)) {
            require("controllers/" . $controller . "Controller.php");
            exit();
        }

        abort(404);
    }
}
