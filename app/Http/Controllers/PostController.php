<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    protected $postService; // Propiedad para guardar la instancia del servicio

    //Utilizamos el metodo constructor para inyectar el servicio
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Muestra la lista de todos los posts.
     */
    public function index()
    {
        // 1. Obtener todos los posts de la DB.
        $posts = $this->postService->getAllPosts();

        // 2. Retornar la vista 'posts.index', pasándole los datos.
        return view('posts.index', compact('posts'));
    }

    /**
     * Muestra el formulario para crear un nuevo post.
     */
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:150',
            'contenido' => 'required',
            'publicado' => 'boolean',
        ]);

        try {
            $post = $this->postService->createPost($validated);

            // SI LA PETICIÓN VIENE DE REACT (AXIOS)
            if ($request->expectsJson()) {
                return response()->json($post, 201);
            }

            // SI LA PETICIÓN VIENE DE UN FORMULARIO BLADE
            return redirect()->route('posts.index')->with('success', 'Post creado!');
        
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Post $post)
    {
        //El post ya fue cargado automáticamente por Laravel (gracias a Route Model Binding)
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //El post ya fue cargado. Simplemente lo pasamos a la vista.
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:150',
            'contenido' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id
        ]);

        try{
            $this->postService->updatePost($post, $request->all());
            return redirect()->route('posts.show', $post)->with('success', 'Publicacion actualizada exitosamente!');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Post $post)
    {
        try{
            $this->postService->deletePost($post);
            return redirect()->route('posts.index')->with('success', 'Publicación eliminada exitosamente.');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
