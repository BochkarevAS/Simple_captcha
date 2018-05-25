<?php

namespace App\Core;

class Controller
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function render($templateName, array $data = [], $layoutName = 'layout/layout')
    {
        $view = $this->container->make(View::class);
        return $view->render($templateName, $data, $layoutName);
    }
}