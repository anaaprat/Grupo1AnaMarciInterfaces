<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
|
*/

// Rutas de autenticación (login)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);

// Rutas protegidas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    // Ruta para usuarios regulares
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');

    // Ruta para administradores
    Route::get('/admin/index', function () {
        return view('admin.index'); // Asegúrate de tener esta vista
    })->name('admin.index');
});

// Redirigir temporalmente la raíz a la página de login
Route::get('/', function () {
    return redirect('/login');
});

// Redirigir si no encuentra una ruta específica
Route::fallback(function () {
    return redirect('/');
});
