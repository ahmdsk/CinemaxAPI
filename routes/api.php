<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\BookingMovieController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
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
Route::post('/movies/create/genre', [MovieController::class, 'create_genre'])->name('movies.create.genre');
Route::put('/movies/edit/{id}', [MovieController::class, 'update'])->name('movies.edit');
Route::delete('/movies/delete/{id}', [MovieController::class, 'delete'])->name('movies.delete');

// Genre
Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');
Route::post('/genre/create', [GenreController::class, 'create'])->name('genre.create');
Route::put('/genre/edit/{id}', [GenreController::class, 'update'])->name('genre.edit');
Route::delete('/genre/delete/{id}', [GenreController::class, 'delete'])->name('genre.delete');

// Actor
Route::get('/actor', [ActorController::class, 'index'])->name('actor.index');
Route::post('/actor/create', [ActorController::class, 'create'])->name('actor.create');
Route::post('/actor/edit/{id}', [ActorController::class, 'update'])->name('actor.edit');
Route::delete('/actor/delete/{id}', [ActorController::class, 'delete'])->name('actor.delete');

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

// Booking
Route::get('/booking', [BookingMovieController::class, 'index'])->name('booking.index');
Route::get('/booking/show/{id}', [BookingMovieController::class, 'show'])->name('booking.show');
Route::post('/booking/create', [BookingMovieController::class, 'create'])->name('booking.create');

// Checkout
Route::post('/checkout/{id}', PaymentController::class)->name('checkout');