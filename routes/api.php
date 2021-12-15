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

    Route::post('/anime/list', [TitleController::class, 'addAnimeToList'])->name('list.anime.add');
    Route::post('/manga/list', [TitleController::class, 'addMangaToList'])->name('list.manga.add');

    Route::delete('/anime/list', [TitleController::class, 'delAnimeFromList'])->name('list.anime.del');
    Route::delete('/manga/list', [TitleController::class, 'delMangaFromList'])->name('list.manga.del');

    Route::put('/anime/list', [TitleController::class, 'updateAnimeStatus'])->name('list.anime.upd');
    Route::put('/manga/list', [TitleController::class, 'updateMangaStatus'])->name('list.manga.upd');
});

/*
 *  Comment Group
 */

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/anime/{id}/comment', [])->name('comment.anime.add');
    Route::post('/manga/{id}/comment', [])->name('comment.manga.add');

    Route::delete('/anime/{id}/comment', [])->name('comment.anime.del');
    Route::delete('/anime/{id}/comment', [])->name('comment.anime.del');

    Route::put('/anime/{id}/comment', [])->name('comment.anime.upd');
    Route::put('/anime/{id}/comment', [])->name('comment.anime.upd');
});

/*
 *  Routes without auth
 */

Route::get('/anime/{id}', [AnimeController::class, 'apiGet'])->name('anime.signle');
Route::get('/manga/{id}', [MangaController::class, 'apiGet'])->name('magna.single');

Route::get('/anime/{id}/comment', [])->name('comment.anime.get');
Route::get('/anime/{id}/comment', [])->name('comment.anime.get');

Route::post('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
