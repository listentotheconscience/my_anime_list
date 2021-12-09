<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimeAddRatingRequest;
use App\Http\Requests\AnimeGetByIdRequest;
use App\Http\Resources\AnimeResource;
use App\Repositories\AnimeRepository;
use App\Services\AnimeService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    use ApiResponser;

    private AnimeRepository $animeRepository;
    private AnimeService $animeService;

    public function __construct(
        AnimeRepository $animeRepository,
        AnimeService $animeService
    )
    {
        $this->animeRepository = $animeRepository;
        $this->animeService = $animeService;
    }

    public function apiGet(AnimeGetByIdRequest $request)
    {
        return AnimeResource::make(
            $this->animeRepository->getById($request->id)
        );
    }

    public function addRating(AnimeAddRatingRequest $request)
    {
         $response = $this->animeService->addRating($request->id, $request->rating, auth()->id());
         return $this->success($response);
    }
}
