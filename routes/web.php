<?php

use App\Http\Controllers\ProfileController; // <-- Agregamos el controlador del perfil
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas del perfil que Laravel necesita para el menú
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTAS TEMPORALES PARA TU PRUEBA DE ARCHIVOS ---
    Route::get('/subir-archivos', function () {
        return view('posts.create');
    });
    Route::post('/posts', [PostController::class, 'store']);
    // ---------------------------------------------------
});

require __DIR__.'/auth.php';