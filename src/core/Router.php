<?php

class Router
{
    private $routes;
    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function resolve($path) {
        foreach ($this->routes as $route => $params) {
            if ($route === $path) {
                return $params;
            }
        }
        return false;
    }
}
