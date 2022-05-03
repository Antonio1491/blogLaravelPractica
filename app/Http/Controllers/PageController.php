<?php

namespace App\Http\Controllers;

Use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //imprimir todos los post
    public function posts()
    {
        //with método de eloquent
        return view('posts', [
            'posts' => Post::with('user')->latest()->paginate()
        ]);
    }
    
    public function post(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
