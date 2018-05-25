<?php

namespace App\Core;

class Kernel
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public static function classLoader($class)
    {
        $class = strtr($class, [
            'App' => 'src',
            '\\' => DIRECTORY_SEPARATOR
        ]);

        $path = ROOT . DIRECTORY_SEPARATOR . $class . '.php';

        if (is_file($path)) {
            include_once($path);
        }
    }

    public function run()
    {
        $router = $this->container->make(Router::class);
        echo $router->run();
    }
}