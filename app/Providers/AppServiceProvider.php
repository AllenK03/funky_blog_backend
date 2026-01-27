<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\EloquentPostRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registramos la conexión entre la interfaz y la implementación
        $this->app->bind(PostRepositoryInterface::class, EloquentPostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Forzamos a Carbon a usar el idioma configurado en la app
        Carbon::setLocale(config('app.locale'));
    }
}
