<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Importar correctamente Request
use Illuminate\Support\Facades\Auth; // Importar correctamente Auth

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja la autenticación de usuarios para la aplicación y
    | redirige a la pantalla principal después del login.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redirección después del login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; // Cambia esto según dónde quieras redirigir

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // No es necesario middleware 'auth' para logout
    }

    /**
     * Mostrar el formulario de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Asegúrate de tener esta vista en resources/views/auth/login.blade.php
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
            // Verificar si el usuario está activo
            if ($user->is_active) {
                return redirect()->intended($this->redirectTo); // Redirigir al dashboard u otra ruta
            } else {
                Auth::logout();
                return back()->withErrors(['Su cuenta no está activa.']); // Error si la cuenta no está activa
            }
        }

        // Credenciales inválidas
        return back()->withErrors(['Las credenciales son incorrectas.']);
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->is_active) {
            Auth::logout();
            return redirect('/login')->with('error', 'Tu cuenta aún no ha sido activada por el administrador.');
        }

        return redirect()->intended($this->redirectPath());
    }
}
