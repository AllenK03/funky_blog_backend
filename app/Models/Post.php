<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    // Define las columnas que pueden ser asignadas masivamente por seguridad
    protected $fillable = [
        'user_id',
        'titulo',
        'slug',
        'contenido',
        'imagen_portada',
        'publicado',
    ];


    /**
     * Define la relación: Un Post pertenece a un Usuario.
     */
    public function user() : BelongsTo
    {
        //Esto asume que tienes un modelo User en App\Models\User
        return $this->belongsTo(User::class);
    }
}
