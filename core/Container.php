<?php

namespace Core;

class Container
{
    public static function NewController($controller)
    {
        $controller = "App\\Controllers\\" . $controller;
        return new $controller;
    }

    public static function pageNotFound()
    {
        if(file_exists(__DIR__ . "/../app/views/404.phtml")){
            return require_once __DIR__ . "/../app/views/404.phtml";
        }else{
            echo "Erro 404: Page not found!";
        }
    }
}