<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use App\Http\Requests\MangaAddRatingRequest;
use App\Http\Requests\MangaDeleteRatingRequest;
use App\Http\Requests\UpdateMangaRatingRequest;
use App\Services\MangaService;

class RatingController extends Controller
{
    private MangaService $mangaService;

    public function __construct(
        MangaService $mangaService,
    )
    {
        $this->mangaService = $mangaService;
    }

    public function create(MangaAddRatingRequest $request)
    {
        $response = $this->mangaService->addRating($request->id, $request->rating, auth()->id());

        return $this->success($response);
    }

    public function update(UpdateMangaRatingRequest $request)
    {
        $response = $this->mangaService->updateRating($request->id, $request->rating_id, $request->rating);

        return $this->success($response);
    }

    public function delete(MangaDeleteRatingRequest $request)
    {
        $response = $this->mangaService->delRating($request->id, auth()->id());

        return $this->success($response);
    }
}
