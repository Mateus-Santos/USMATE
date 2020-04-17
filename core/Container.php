<?php

namespace Core;

class Container
{
    //Função na qual instancia um controller base
    public static function NewController($controller)
    {
        $controller = "App\\Controllers\\" . $controller;
        return new $controller;
    }

    // Função que instancia uma model base.
    public static function getModel($model)
    {
        $objModel = "App\\Models\\" . $model;
        return new $objModel(DataBase::getDataBase());
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