<!DOCTYPE html>
<html>
<head>
    <title>Editar: {{ $post->titulo }}</title>
</head>
<body>
    <h1>Editar Publicación: {{ $post->titulo }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post->id) }}">
        @csrf
        @method('PUT')

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $post->titulo) }}" required><br><br>

        <label for="slug">Slug (URL amigable):</label><br>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" required><br><br>
        
        <label for="contenido">Contenido:</label><br>
        <textarea id="contenido" name="contenido" rows="10" required>{{ old('contenido', $post->contenido) }}</textarea><br><br>
        
        <label for="publicado">Publicar Ahora:</label>
        <input type="checkbox" id="publicado" name="publicado" value="1" {{ old('publicado', $post->publicado) ? 'checked' : '' }}><br><br>
        
        <button type="submit">Guardar Cambios</button>
    </form>

    <hr>
    <a href="{{ route('posts.show', $post) }}">Volver al Post</a> |
    <a href="{{ route('posts.index') }}">Volver al Listado</a>
</body>
</html>