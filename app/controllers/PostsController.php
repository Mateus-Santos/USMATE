<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

use App\Models\Post;

class PostsController extends BaseController
{

    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = Container::getModel("Post");
    }

    public function index()
    {
        //validação para caso a atualização for efetuada com sucesso!
        if(Session::get('success')){
            $this->view->success = Session::get('success');
            Session::destroy('success');
        }
        //validação para caso a atualização der algum problema!
        if(Session::get('errors')){
            $this->view->errors = Session::get('errors');
            Session::destroy('errors');
        }
        //Metodo para dar um titulo dinamico para a pagina.
        $this->setPageTitle('Posts');
        //onde pega todos os elementos da tabela e instancia no atributo posts.
        $this->view->posts = $this->post->All();
        //Renderizar a views.
        return $this->renderView('posts/index', 'layout');
    }

    public function show($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle("{$this->view->post->title}");
        $this->renderView('posts/show', 'layout');
    }

    public function create()
    {
        $this->setPageTitle('New Post');
        $this->renderView('posts/create', 'layout');
    }

    //Primiero nome da coluna da tabela e depois o nome do value.
    /**
     * 
     * É necessario fazer validações de segurança para evitar sqlinjection, apos o termino do framework todas essa validações serão realizadas! 
     * 
     * */ 
    public function store($request)
    {
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];
        if($this->post->create($data))
        {
            return Redirect::route('/posts'); 
        }else{
            return "Error: Erro ao inserir no banco.";
        }        
    }

    //Chama view edit para realziar a alteração de dados.
    public function edit($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle('Edit post - ' . $this->view->post->title);
        $this->renderView('posts/edit', 'layout');
    }

    //Função para realizar a atualização de uma tabela no banco de dados
    public function update($id, $request)
    {
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];

        /*  Aqui é feita a validação para verificar se a atualização foi 
            feita com sucesso, utilizando uma função chamada update na 
            BaseModel localizada no diretorio Core.
        */
        if($this->post->update($data, $id)){
            return Redirect::route('/posts', [
                'success' => ['Post atualizado com sucesso!']
            ]);
        }else{
            return Redirect::route('/posts', [
                'errors' => ['Erro ao atualizar!!']
            ]);
        } 
    }

    public function delete($id)
    {
        if($this->post->delete($id)){
            return Redirect::route('/posts');
        }else{
            return "Erro ao deletar";
        }    
    }
}