<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->titulo }}</title>
</head>
<body>
    <p><a href="{{ route('posts.index') }}"> Volver al Listado</a></p>

    <a href="{{ route('posts.edit', $post) }}">Editar Post</a> |
    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE') <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este post?')" style="color:red; border:none; background:none; cursor:pointer;">Eliminar Post</button>
    </form>
    
    <h1>{{ $post->titulo }}</h1>
    
    <small>Publicado por: {{ $post->user->name }} el {{ $post->created_at->format('d/m/Y h:i A') }}
        ({{ $post->created_at->diffForHumans()}})
    </small>
    
    <div style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px;">
        {!! nl2br(e($post->contenido)) !!}
    </div>

</body>
</html>