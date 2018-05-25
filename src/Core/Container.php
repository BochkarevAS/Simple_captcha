<?php

namespace App\Core;

class Container
{
    protected $bindings = [];

    public function bind($key, $value)
    {
        $this->bindings[$key] = $value;

        return $this;
    }

    public function make($key)
    {
        if (array_key_exists($key, $this->bindings)) {
            $resolver = $this->bindings[$key];
            return $resolver($this);
        }

        throw new \Exception("Компонент $key в контейнере не найден");
    }
}