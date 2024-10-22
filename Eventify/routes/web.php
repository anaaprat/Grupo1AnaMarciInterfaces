<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventAttendeeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::resource('categories', CategoryController::class);
Route::resource('events', EventController::class);
Route::resource('event-attendees', EventAttendeeController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('payments', PaymentController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('users', UserController::class);