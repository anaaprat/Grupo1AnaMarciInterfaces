<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;  // Asegúrate de importar Auth
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;

// Ruta raíz
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('users.index');
        }
        return redirect()->route('users.dashboard');
    }
    return view('auth.login');
})->name('login'); 

Route::resource('users', UserController::class)->middleware('auth');

Auth::routes();
// Middleware para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta para el dashboard de usuarios regulares
    Route::get('/dashboard', function () {
        return view('users.dashboard');  // Vista para usuarios regulares
    })->name('users.dashboard');

    // Ruta protegida que requiere verificación de email
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Ruta de verificación de email (GET)
Route::get('/email/verify', [VerificationController::class, 'show'])->middleware('auth')
    ->name('verification.notice');

// Ruta para manejar el enlace de verificación de correo electrónico (GET)
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'auth']) // Solo esta ruta requiere el middleware 'signed'
    ->name('verification.verify');

// Ruta de reenvío de verificación de email (POST) con limitación de reintentos
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware('throttle:6,1') // Solo esta ruta necesita 'throttle'
    ->name('verification.resend');


//Admin
Route::get('/users', action: [UserController::class, 'index'])->name('users.index')->middleware('role:admin');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('role:admin');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:admin');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:admin');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('role:admin');


