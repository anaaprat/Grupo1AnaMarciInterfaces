<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterAPIController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Endpoints de autenticación
//Para hacer login
//http://127.0.0.1:8000/api/login?email=anaprat26@gmail.com&password=12345678

//Para hacer register
//http://127.0.0.1:8000/api/login?name=anitaprat&email=anitaprat@gmail.com&password=12345678&c_password=12345678
Route::controller(RegisterAPIController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Ver todos los usuarios que tenemos en la base de datos
//http://127.0.0.1:8000/api/users
Route::get('/users', [UserController::class, 'index']);

//Buscar y enseñar solo un usuario
//http://127.0.0.1:8000/api/users/1
Route::get('/users/{user}', [UserController::class, 'show']);

//Ver todos los eventos que tenemos en la base de datos
//http://127.0.0.1:8000/api/events
Route::get('/events', [EventController::class, 'index']);

//para poder añadir a un evento 
//http://127.0.0.1:8000/api/events?organized_id=22&title=Concierto&description=Lleno de artistas de todo el mundo&category_id=1&start_time=2025-01-06%2016:54:24&end_time=2025-06-06%2016:54:24&location=San Fernando&max_attendees=5000&price=90.97
Route::post('/events', [EventController::class, 'store']);

//para poder ver el que acabas de añadir/el que quieras ver (enseña solo un evento)
//http://127.0.0.1:8000/api/events/13
Route::get('/events/{event}', [EventController::class, 'show']);

//para poder actucalizar un evento (el que hemos creado mismo)
//http://127.0.0.1:8000/api/events/13?title=Conciertazo
Route::put('/events/{event}', [EventController::class, 'update']);

//Para eliminar el que acabamos de crear
//http://127.0.0.1:8000/api/events/13
Route::delete('/events/{event}', [EventController::class, 'destroy']);
