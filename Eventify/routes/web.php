<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;  // Asegúrate de importar Auth

// Ruta raíz
Route::get('/', function () {
    // Si el usuario ha iniciado sesión
    if (Auth::check()) {
        // Si es administrador, redirige a la vista de gestión de usuarios
        if (Auth::user()->role === 'Admin') {
            return redirect()->route('users.index');  // Vista de admin
        }

        // Si es un usuario regular, redirige a la vista principal para todos los usuarios
        return redirect()->route('user.dashboard');  // Redirige al dashboard del usuario
    }

    // Si no ha iniciado sesión, mostrar la página de login
    return view('auth.login');
});

// Middleware para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Ruta para el dashboard de usuarios regulares
    Route::get('/dashboard', function () {
        return view('user.dashboard');  // Vista para usuarios regulares
    })->name('user.dashboard');

    // Ruta para la gestión de usuarios, solo accesible para admin
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('admin');
    
    // Otras rutas protegidas
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

// Rutas de autenticación (login, registro, etc.)
Auth::routes();
