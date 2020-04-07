<?php

namespace App\Controllers;

class PostsController
{
    public function index(){
        echo "test 2";
    }

    public function show($id, $request){
        echo $id . '<br>';
        print_r($_GET);
    }
}