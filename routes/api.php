<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MangaController;
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


Route::post('/auth/signup', [AuthController::class, 'signup']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/anime/addRating', [AnimeController::class, 'addRating']);
    Route::post('/manga/addRating', [MangaController::class, 'addRating']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::get('/anime/{id}', [AnimeController::class, 'apiGet']);
Route::get('/manga/{id}', [MangaController::class, 'apiGet']);
