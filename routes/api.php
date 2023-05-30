<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

// Movies
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::post('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::put('/movies/edit/{id}', [MovieController::class, 'update'])->name('movies.edit');
Route::delete('/movies/delete/{id}', [MovieController::class, 'delete'])->name('movies.delete');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::post('/events/create', [EventController::class, 'create'])->name('events.create');
Route::put('/events/edit/{id}', [EventController::class, 'update'])->name('events.edit');
Route::delete('/events/delete/{id}', [EventController::class, 'delete'])->name('events.delete');

// Seat
Route::get('/seats', [SeatController::class, 'index'])->name('seats.index');
Route::post('/seats/create', [SeatController::class, 'create'])->name('seats.create');
Route::put('/seats/edit/{id}', [SeatController::class, 'update'])->name('seats.edit');
Route::delete('/seats/delete/{id}', [SeatController::class, 'delete'])->name('seats.delete');

// Tickets
Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');