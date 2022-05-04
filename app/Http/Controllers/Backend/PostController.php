<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));

        // $posts = Post::all();

        // return view ('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //salvar/crear/guardar
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all() );

        //image
        if($request->file('file')){
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        //return
        return back()->with('status', 'Creado con éxito');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $pos
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //nombre de la carpte.nombre del archivo
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $pos
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // dd($request->all());
        $post->update($request->all());

        //image
        if($request->file('file')){
            //eliminar imagen
            Storage::disk('public')->delete($post->image);

            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        return back()->with('status', 'Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $pos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Eliminación de la imagen
        //eliminar imagen
        Storage::disk('public')->delete($post->image); 
        
        $post->delete();

        // Retornar a la ventana anterior enviando un msj dentro de la variable de sesión llamada status
        return back()->with('status', 'Eliminado con éxito');
    }
}
