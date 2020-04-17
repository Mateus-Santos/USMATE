<?php

namespace Core;

abstract class BaseController
{
    protected $view;
    private $viewPath;
    private $layoutPath;
    private $pageTitle = null;
    
    public function __construct()
    {
        $this->view = new \stdClass;
    }

    //Função para renderizar uma view caso tenha layout ou não.
    protected function renderView($viewPath, $layoutPath = null)
    {
        $this->viewPath = $viewPath;
        $this->layoutPath = $layoutPath;
        if($layoutPath){
            return $this->layout();
        }else{
            return $this->content();
        }   
    }

    //Função que define a extenção padrão de arquivos que será usada na view e onde vai procurar o arquivo da view para iniciar.
    protected function content()
    {
        if(file_exists(__DIR__ . "/../app/views/{$this->viewPath}.phtml")){
            return require_once __DIR__ . "/../app/views/{$this->viewPath}.phtml";
        }else{
            echo "Error: View path not found!";
        }
    }

    //Faz a mesma coisa que a função content porem para layouts.
    protected function layout()
    {
        if(file_exists(__DIR__ . "/../app/views/{$this->layoutPath}.phtml")){
            return require_once __DIR__ . "/../app/views/{$this->layoutPath}.phtml";
        }else{
            echo "Error: Layout path not found!";
        }
    }

    /*Essas funções abaixo foram feitas para o uso de titulos dinamicos, não é 
    necessaria o seu uso caso não queira utilizar um projeto com os titulos dinamicos*/
    protected function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    //Essa função para caso queira fazer um uso de algum caracter que separe o titulo dinamico do titulo padrão.
    protected function getPageTitle($separator = null)
    {
        if($separator){
            return $this->pageTitle . " " . $separator . " "; 
        }else{
            return $this->pageTitle;
        }
    }
}