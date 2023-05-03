<?php

use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::apiResource('film/',CustomerController::class);

Route::POST('film/add', [FilmController::class, 'store']);
Route::GET('film/view', [FilmController::class, 'index']);
Route::DELETE('film/delete',[FilmController::class, 'destroy']);
Route::PUT('film/update', [FilmController::class, 'update']);