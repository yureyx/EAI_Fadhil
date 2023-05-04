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

Route::apiResource('film', FilmController::class);

Route::post('film/add', [FilmController::class, 'store']);
Route::get('film/view/{id}', [FilmController::class, 'show']);
Route::delete('film/delete/{id}', [FilmController::class, 'destroy']);
Route::post('film/update/{id}', [FilmController::class, 'update']);
