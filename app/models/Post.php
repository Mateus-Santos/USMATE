<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = "Posts";

    public $timestamps = false;

    protected $filable = ['title', 'content'];

    public function rules()
    {
        return[
            'title' => 'min:5|max:10',
            'content' => 'min:30'
        ];
    }
}