<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeatController;

Route::get('/movies/{movie_id}/seats', [SeatController::class, 'index']);
Route::post('/movies/{movie_id}/seats/{seat_id}/reserve', [SeatController::class, 'reserve']);

Route::post('/movies/{movie_id}/add_seats', [SeatController::class, 'addSeats']);
Route::delete('/movies/{movie_id}/remove_seats', [SeatController::class, 'removeSeats']);
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
