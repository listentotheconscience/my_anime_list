<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimeGetByIdRequest;
use App\Http\Resources\AnimeResource;
use App\Repositories\AnimeRepository;

class AnimeController extends Controller
{
    private AnimeRepository $animeRepository;

    public function __construct(
        AnimeRepository $animeRepository,
    )
    {
        $this->animeRepository = $animeRepository;
    }

    public function get(AnimeGetByIdRequest $request)
    {
        return AnimeResource::make(
            $this->animeRepository->getById($request->id)
        );
    }
}
