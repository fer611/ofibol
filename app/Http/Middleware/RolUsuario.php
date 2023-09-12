<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        // Verificar si el usuario tiene solo el rol de "Cliente"
        if ($user && $user->roles->count() === 1 && $user->hasRole('Cliente')) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
