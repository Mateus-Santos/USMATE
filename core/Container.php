<?php

namespace Core;

class Container
{
    public static function NewController($controller)
    {
        $controller = "App\\Controllers\\" . $controller;
        return new $controller;
    }
}