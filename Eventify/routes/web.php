<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;



// Ruta raíz
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'a') {
            return redirect()->route('users.index');
        }else if(Auth::user()->role === 'u'){
            return redirect()->route('users.dashboard');
        }else{
            return redirect()->route('events.index');

        }
    }
    return view('welcome');
})->name('login');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware(middleware: 'role:a');

Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/dashboard', function () {
        return view('users.dashboard');
    })->name('users.dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware('verified');
});

// Notificación de verificación de email
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth', 'role:u')
    ->name('verification.notice');

// Enlace de verificación de correo electrónico
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'auth'])
    ->name('verification.verify');

// Reenvío de verificación de email
Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

//Organizador 
Route::resource('events', controller: EventController::class);


//Admin
Route::get('/users', action: [UserController::class, 'index'])->name('users.index')->middleware('role:a');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('role:a');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:a');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:a');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('role:a');


