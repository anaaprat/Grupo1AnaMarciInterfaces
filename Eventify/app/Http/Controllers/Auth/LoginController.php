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
        $user = Auth()->user();

        return $user->role === 'admin' ? '/users' : '/';
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