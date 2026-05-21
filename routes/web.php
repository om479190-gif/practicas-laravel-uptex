<?php

use App\Http\Controllers\ProfileController; // <-- Agregamos el controlador del perfil
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = App\Models\Post::with('user', 'category')->latest()->paginate(10);
    
    // Estadísticas para los reportes básicos
    $totalPosts = App\Models\Post::count();
    $totalUsers = App\Models\User::count();
    $misPosts = App\Models\Post::where('user_id', auth()->id())->count();
    
    return view('dashboard', compact('posts', 'totalPosts', 'totalUsers', 'misPosts'));
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas del perfil que Laravel necesita para el menú
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    // --- RUTAS TEMPORALES PARA TU PRUEBA DE ARCHIVOS ---
    Route::get('/subir-archivos', function () {
        return view('posts.create');
    });
    Route::post('/posts', [PostController::class, 'store']);
    // ---------------------------------------------------
});

require __DIR__.'/auth.php';