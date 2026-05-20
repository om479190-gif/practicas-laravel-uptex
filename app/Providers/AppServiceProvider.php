<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- IMPORTANTE: Agregar esta línea para usar los Gates

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Regla para ver el dashboard
        Gate::define('view-dashboard', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });

        // Regla para editar posts
        Gate::define('edit-post', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });

        // Regla para eliminar posts
        Gate::define('delete-post', function ($user) {
            return $user->hasRole('admin');
        });
    }
}

http://googleusercontent.com/immersive_entry_chip/0