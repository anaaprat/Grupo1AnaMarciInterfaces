<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth correctamente

class HomeController extends Controller
{
    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Solo usuarios autenticados pueden acceder
    }

    /**
     * Mostrar el dashboard de la aplicación según el rol del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Redirigir según el rol del usuario autenticado
        if (Auth::user()->role === 'Admin') {
            return redirect()->route('admin.dashboard'); // Redirigir al dashboard de admin
        }

        return redirect()->route('users.dashboard'); // Redirigir al dashboard de usuario regular
    }
}
