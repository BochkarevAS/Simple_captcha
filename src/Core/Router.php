<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $container;

    public function __construct(Container $container, $routes)
    {
        $this->container = $container;
        $this->routes = $routes;
    }

    public function run()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route => $callable) {
            if (preg_match("~^$route$~", $uri, $matches)) {
                $callable[0] = $this->container->make($callable[0]);
                unset($matches[0]); // Убераю от туда путь ...

                return call_user_func_array($callable, $matches);
            }
        }

        throw new \HttpException('Not found', 404);
    }
}