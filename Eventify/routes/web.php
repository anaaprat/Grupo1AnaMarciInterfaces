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

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('role:admin');


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

// Notificación de verificación de email
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth', 'role:User')
    ->name('verification.notice');

// Enlace de verificación de correo electrónico
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'auth'])
    ->name('verification.verify');

// Reenvío de verificación de email
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

//Admin
Route::get('/users', action: [UserController::class, 'index'])->name('users.index')->middleware('role:admin');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('role:admin');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:admin');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:admin');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('role:admin');


