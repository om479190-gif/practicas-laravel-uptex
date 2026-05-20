<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verifica si el usuario no ha iniciado sesión, o si no tiene el rol requerido
        if (!auth()->check() || !auth()->user()->hasRole($role)) {
            abort(403, 'Unauthorized access'); // Muestra error 403
        }

        // Si todo está bien, lo deja pasar
        return $next($request);
    }
}