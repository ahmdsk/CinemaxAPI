<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\MovieController;
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