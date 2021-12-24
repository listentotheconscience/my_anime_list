<?php

use App\Http\Controllers\Anime\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\Manga\MangaController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TitleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Anime\CommentController as AnimeCommentController;
use App\Http\Controllers\Manga\CommentController as MangaCommentController;
use App\Http\Controllers\Anime\TitleController as AnimeTitleController;
use App\Http\Controllers\Manga\TitleController as MangaTitleController;
use App\Http\Controllers\Anime\RatingController as AnimeRatingController;
use App\Http\Controllers\Manga\RatingController as MangaRatingController;

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




Route::domain('mal.' . env('APP_URL'))->group(function () {
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
        Route::post('/anime/rating', [AnimeRatingController::class, 'create'])->name('rating.anime.add');
        Route::post('/manga/rating', [MangaRatingController::class, 'create'])->name('rating.manga.add');

        Route::delete('/anime/rating', [AnimeRatingController::class, 'delete'])->name('rating.anime.delete');
        Route::delete('/manga/rating', [MangaRatingController::class, 'delete'])->name('rating.manga.delete');

        Route::put('/anime/rating', [AnimeRatingController::class, 'update'])->name('rating.anime.update');
        Route::put('/manga/rating', [MangaRatingController::class, 'update'])->name('rating.manga.update');
    });

    /*
     *  List Group
     */

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/list', [TitleController::class, 'list'])->name('list.me');

        Route::post('/anime/list', [AnimeTitleController::class, 'create'])->name('list.anime.add');
        Route::post('/manga/list', [MangaTitleController::class, 'create'])->name('list.manga.add');

        Route::delete('/anime/list', [AnimeTitleController::class, 'delete'])->name('list.anime.del');
        Route::delete('/manga/list', [MangaTitleController::class, 'delete'])->name('list.manga.del');

        Route::put('/anime/list', [AnimeTitleController::class, 'update'])->name('list.anime.upd');
        Route::put('/manga/list', [MangaTitleController::class, 'update'])->name('list.manga.upd');
    });

    /*
     *  Comment Group
     */

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/anime/{id}/comment', [AnimeCommentController::class, 'create'])->name('comment.anime.add');
        Route::post('/manga/{id}/comment', [MangaCommentController::class, 'create'])->name('comment.manga.add');

        Route::delete('/anime/{id}/comment', [AnimeCommentController::class, 'delete'])->name('comment.anime.del');
        Route::delete('/anime/{id}/comment', [MangaCommentController::class, 'delete'])->name('comment.anime.del');

        Route::put('/anime/comment', [AnimeCommentController::class, 'update'])->name('comment.anime.upd');
        Route::put('/anime/comment', [MangaCommentController::class, 'update'])->name('comment.anime.upd');
    });

    /*
     *  Follower Group
     */

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/me/follows', [FollowerController::class, 'follows'])->name('follower.all.follows');

        Route::get('/me/followers', [FollowerController::class, 'followers'])->name('follower.all.followers');

        Route::post('/user/{id}/follow', [FollowerController::class, 'create'])->name('follower.follow');

        Route::delete('/user/{id}/follow', [FollowerController::class, 'delete'])->name('follower.unfollow');
    });

    /*
     *  Routes without auth
     */

    Route::group([], function () {
        Route::get('/anime/{id}', [AnimeController::class, 'get'])->name('anime.single');
        Route::get('/manga/{id}', [MangaController::class, 'get'])->name('magna.single');

        Route::get('/anime/{id}/comments', [AnimeCommentController::class, 'get'])->name('comments.anime.get');
        Route::get('/manga/{id}/comments', [MangaCommentController::class, 'get'])->name('comments.manga.get');

        Route::post('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');
        Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    });
});

/*
 * Test Group
 * Only Dev
 */
//Route::get('/test',[TestController::class, 'test']);
