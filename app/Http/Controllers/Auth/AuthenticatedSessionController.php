<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Intenta autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Obtiene el usuario autenticado
            $user = Auth::user();

            // Verifica el estado del usuario
            if ($user->estado === '1') { // Activo
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            } else { // Inactivo
                // Desconecta al usuario
                Auth::logout();

                // Regenera la sesión
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Redirige al formulario de inicio de sesión con un mensaje de error
                return redirect()->route('login')->withErrors(['email' => 'Tu cuenta está inactiva.']);
            }
        }

        // Si la autenticación falla, redirige al formulario de inicio de sesión
        return redirect()->route('login')->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.']);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
