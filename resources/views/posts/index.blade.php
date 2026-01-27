<!DOCTYPE html>
<html>
<head>
    <title>Publicaciones - Blog POO</title>
</head>
<body>
    <h1>Listado de Publicaciones</h1>
    <p><a href="{{ route('posts.create') }}">Crear Nueva Publicación</a></p>

    @if (session('success'))
        <p style="color: green; border: 1px solid green; padding: 10px;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    @forelse ($posts as $post)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;">
            <h2>{{ $post->titulo }}</h2>
            <p><strong>Estado:</strong> {{ $post->publicado ? 'Publicado' : 'Borrador' }}</p>
            
            <p>{{ Str::limit($post->contenido, 100) }}</p> 
            
            <small>Creado el: {{ $post->created_at->format('d/m/Y') }}</small>
            <br>
            <a href="{{ route('posts.show', $post->id) }}">Ver Detalle</a>
        </div>
    @empty
        <p>No hay publicaciones creadas. ¡Empieza creando una!</p>
    @endforelse

</body>
</html>