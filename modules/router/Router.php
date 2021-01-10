<?php

class Router
{
    private $uri;

    private $routes = [];

    public function __construct($uri)
    {
        $this->uri = parse_url($uri, PHP_URL_PATH);
    }

    public function get($path, $action)
    {
        $route = new Route($path, $action);
        $this->routes['GET'][] = $route;
    }

    public function post($path, $action)
    {
        $route = new Route($path, $action);
        $this->routes['POST'][] = $route;
    }

    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            echo 'Does not have any routes for method ' . $_SERVER['REQUEST_METHOD'];
            return false;
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->uri)) {
                $route->call();
                return true;
            }
        }
        echo '404 - Page not found';
        return false;
    }
}