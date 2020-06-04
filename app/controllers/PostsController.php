<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Post;

class PostsController extends BaseController
{

    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = new Post;
    }

    public function index()
    {
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
       return  $this->renderView('posts/show', 'layout');
    }

    public function create()
    {
        $this->setPageTitle('New Post');
        return $this->renderView('posts/create', 'layout');
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

        try{
            $this->post->create($data);
            return Redirect::route('/posts', [
                'success' => ['Post criado com sucesso!']
            ]);
        }catch(\Exception $e){
            return Redirect::route('/posts',[
                'errors' => [$e->getMessage()]
            ]);
        }

        /*if($this->post->create($data))
        {
            return Redirect::route('/posts'); 
        }else{
            return "Error: Erro ao inserir no banco.";
        }*/   
    }

    //Chama view edit para realziar a alteração de dados.
    public function edit($id)
    {
        $this->view->post = $this->post->find($id);
        $this->setPageTitle('Edit post - ' . $this->view->post->title);
        return $this->renderView('posts/edit', 'layout');
    }

    //Função para realizar a atualização de uma tabela no banco de dados
    public function update($id, $request)
    {
        $data = [
            'title' => $request->post->title,
            'content' => $request->post->content
        ];

        if(Validator::make($data, $this->post->rules()))
        {
            return Redirect::route("/post/{$id}/edit");
        }

        try{
            /*$this->post->find($id)->update($data) */
            $post = Post::find($id);
            $post->update($data);
            return Redirect::route('/posts', [
                'success' => ['Post atualizado com sucesso!']
            ]);
        }catch(\Exception $e){
            return Redirect::route('/posts',[
                'errors' => [$e->getMessage()]
            ]);
        }
        /*  Aqui é feita a validação para verificar se a atualização foi 
            feita com sucesso, utilizando uma função chamada update na 
            BaseModel localizada no diretorio Core.
        
        if($this->post->update($data, $id)){
            return Redirect::route('/posts', [
                'success' => ['Post atualizado com sucesso!']
            ]);
        }else{
            return Redirect::route('/posts', [
                'errors' => ['Erro ao atualizar!!']
            ]);
        }
        */
    }

    public function delete($id)
    {
        try{
            $this->post->find($id)->delete();
            return Redirect::route('/posts', [
                'success' => ['Post excluido com sucesso!']
            ]);
        }catch(\Exception $e){
            return Redirect::route('/posts',[
                'errors' => [$e->getMessage()]
            ]);
        }
        /*
        if($this->post->delete($id)){
            return Redirect::route('/posts');
        }else{
            return "Erro ao deletar";
        }
        */
    }
}