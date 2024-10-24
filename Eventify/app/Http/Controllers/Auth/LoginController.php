<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirección después del login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Redirige según el tipo de usuario (admin o usuario regular)
        return auth()->user()->role === 'admin' ? route('users.index') : route('users.dashboard');
    }

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // Permite que solo usuarios no autenticados vean el formulario de login
        $this->middleware('guest')->except('logout');
    }

    /**
     * Mostrar el formulario de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Manejar el login de usuarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Verificar si el usuario está activo (usamos el campo 'actived')
            if ($user->actived) {
                return redirect()->intended($this->redirectTo()); // Redirige al destino según el tipo de usuario
            } else {
                Auth::logout();
                return back()->withErrors(['Su cuenta no está activa.']); // Mensaje si la cuenta no está activa
            }
        }

        // Si las credenciales son incorrectas
        return back()->withErrors(['Las credenciales son incorrectas.']);
    }

    /**
     * Verificar si el usuario está activo después de autenticarse.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->actived) {  // Verificamos si la cuenta está activa usando 'actived'
            Auth::logout();
            return redirect('/login')->withErrors(['Tu cuenta aún no ha sido activada por el administrador.']);
        }

        return redirect()->intended($this->redirectPath());
    }
}