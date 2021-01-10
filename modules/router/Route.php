<?php

class Route
{
    private $path;

    private $action;

    public function __construct($path, $action)
    {
        $this->path = $path;
        $this->action = $action;
    }

    public function match($uri)
    {
        // Match $uri with $this->path
        // true - маршрут совпал
        // false - не совпал
        if ($this->path == $uri) {
            return true;
        }
        return false;
    }

    public function call()
    {
        // Call $this->action
        if (is_string($this->action)) {
            $segments = explode('@', $this->action);
            include_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $segments[0] . '.php';
            call_user_func([new $segments[0](), $segments[1]]);
        } else {
            call_user_func($this->action);
        }
    }
}