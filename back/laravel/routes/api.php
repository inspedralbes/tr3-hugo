<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/movies/{movie_id}/seats', [SeatController::class, 'index']);
Route::post('/movies/{movie_id}/seats/{seat_id}/reserve', [SeatController::class, 'reserve']);

Route::post('/movies/{movie_id}/add_seats', [SeatController::class, 'addSeats']);
Route::delete('/movies/{movie_id}/remove_seats', [SeatController::class, 'removeSeats']);
Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//get de sessiones anidadas

Route::get('/movies/{movie}/sessions', [SessionController::class, 'index']);
Route::post('/movies/{movie}/sessions', [SessionController::class, 'store']);
Route::get('/movies/{movie}/sessions/{session}', [SessionController::class, 'show']);
Route::put('/movies/{movie}/sessions/{session}', [SessionController::class, 'update']);
Route::delete('/movies/{movie}/sessions/{session}', [SessionController::class, 'destroy']);
 
//ticket compra
Route::get('/tickets', [TicketController::class, 'index']);
Route::post('/tickets', [TicketController::class, 'store']);
Route::get('/tickets/{id}', [TicketController::class, 'show']);
Route::put('/tickets/{id}', [TicketController::class, 'update']);
Route::delete('/tickets/{id}', [TicketController::class, 'destroy']);
Route::get('/tickets/{id}/user', [TicketController::class, 'showUserTickets']);