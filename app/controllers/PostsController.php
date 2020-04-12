<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class PostsController extends BaseController
{
    public function index()
    {
        //Metodo para dar um titulo dinamico para a pagina
        $this->setPageTitle('Posts');
        //metodo no qual puxa a model.
        $model = Container::getModel("Post");
        //onde pega todos os elementos da tabela e instancia no atributo posts
        $this->view->posts = $model->All();
        //Renderizar a views
        $this->renderView('posts/index', 'layout');
    }

    public function show($id)
    {
        $model = Container::getModel("Post");
        $this->view->post = $model->find($id);
        $this->setPageTitle("{$this->view->post->title}");
        $this->renderView('posts/show', 'layout');
    }

    public function create()
    {
        $this->setPageTitle('New Post');
        $this->renderView('posts/create', 'layout');
    }

    public function store($request)
    {
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        print_r($request->post);
    }

}