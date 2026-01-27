<!DOCTYPE html>
<html>
<head>
    <title>Crear Nueva Publicación</title>>
</head>
<body>
    <h1>Crear Nueva Publicación</h1>

    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required><br><br>

        <label for="slug">Slug (URL amigable):</label><br>
        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required><br><br>
        
        <label for="contenido">Contenido:</label><br>
        <textarea id="contenido" name="contenido" rows="10" required>{{ old('contenido') }}</textarea><br><br>
        
        <label for="publicado">Publicar Ahora:</label>
        <input type="checkbox" id="publicado" name="publicado" value="1" {{ old('publicado') ? 'checked' : '' }}><br><br>
        
        <input type="hidden" name="user_id" value="1"> 
        <button type="submit">Guardar Publicación</button>
    </form>

    <hr>
    <a href="{{ route('posts.index') }}">Volver al Listado</a>
</body>
</html>