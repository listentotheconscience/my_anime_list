<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimeAddRatingRequest;
use App\Http\Requests\AnimeDeleteRatingRequest;
use App\Http\Requests\UpdateAnimeRatingRequest;
use App\Services\AnimeService;

class RatingController extends Controller
{
    private AnimeService $animeService;

    public function __construct(
        AnimeService $animeService,
    )
    {
        $this->animeService = $animeService;
    }

    public function create(AnimeAddRatingRequest $request)
    {
        $response = $this->animeService->addRating($request->id, $request->rating, auth()->id());

        return $this->success($response);
    }

    public function update(UpdateAnimeRatingRequest $request)
    {
        $response = $this->animeService->updateRating($request->id, $request->rating_id, $request->rating);

        return $this->success($response);
    }

    public function delete(AnimeDeleteRatingRequest $request)
    {
        $response = $this->animeService->delRating($request->id, auth()->id());

        return $this->success($response);
    }
}
