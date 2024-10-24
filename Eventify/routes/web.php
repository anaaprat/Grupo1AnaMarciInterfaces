<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;  // Asegúrate de importar Auth
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;

// Ruta raíz
Route::get('/', function () {
    // Si el usuario ha iniciado sesión
    if (Auth::check()) {
        // Si es administrador, redirige a la vista de gestión de usuarios
        if (Auth::user()->role === 'admin') {
            return redirect()->route('users.index');  // Vista de admin
        }

        // Si es un usuario regular, redirige a la vista principal para todos los usuarios
        return redirect()->route('user.dashboard');  // Redirige al dashboard del usuario
    }

    // Si no ha iniciado sesión, mostrar la página de login
    return view('auth.login');
})->name('login');

// Ruta de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Middleware para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta para el dashboard de usuarios regulares
    Route::get('/dashboard', function () {
        return view('user.dashboard');  // Vista para usuarios regulares
    })->name('user.dashboard');

    // Ruta protegida que requiere verificación de email
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Rutas de autenticación con verificación de email activada
Auth::routes(['verify' => true]);

// Agrupamos las rutas que requieren autenticación
Route::middleware('auth')->group(function () {

    // Ruta de verificación de email (GET)
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Ruta para manejar el enlace de verificación de correo electrónico (GET)
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed') // Solo esta ruta requiere el middleware 'signed'
        ->name('verification.verify');

    // Ruta de reenvío de verificación de email (POST) con limitación de reintentos
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1') // Solo esta ruta necesita 'throttle'
        ->name('verification.resend');
});

// Ruta para la gestión de usuarios, solo accesible para admin
Route::middleware('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

// Rutas de autenticación (login, registro, etc.)
Auth::routes();
