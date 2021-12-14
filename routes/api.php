<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\TitleController;
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

/*
 *  Auth Group
 */

Route::post('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [AuthController::class, 'me'])->name('auth.me');

    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

/*
 *  Rating Group
 */

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/anime/addRating', [AnimeController::class, 'addRating'])->name('rating.anime.add');
    Route::post('/manga/addRating', [MangaController::class, 'addRating'])->name('rating.manga.add');

    Route::post('/anime/delRating', [AnimeController::class, 'delRating'])->name('rating.anime.delete');
    Route::post('/manga/delRating', [MangaController::class, 'delRating'])->name('rating.manga.delete');
});

/*
 *  List Group
 */

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/myList', [TitleController::class, 'getListForMe'])->name('list.me');
    Route::post('/anime/toList', [TitleController::class, 'addAnimeToList'])->name('list.anime.add');
    Route::post('/manga/toList', [TitleController::class, 'addMangaToList'])->name('list.manga.add');

    Route::post('/anime/fromList', [TitleController::class, 'delAnimeFromList'])->name('list.anime.del');
    Route::post('/manga/fromList', [TitleController::class, 'delMagnaFromList'])->name('list.manga.del');
});

Route::get('/anime/{id}', [AnimeController::class, 'apiGet'])->name('anime.signle');
Route::get('/manga/{id}', [MangaController::class, 'apiGet'])->name('magna.single');
