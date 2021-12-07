<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimeGetByIdRequest;
use App\Http\Resources\AnimeResource;
use App\Repositories\AnimeRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    use ApiResponser;

    private AnimeRepository $animeRepository;

    public function __construct(
        AnimeRepository $animeRepository
    )
    {
        $this->animeRepository = $animeRepository;
    }

    public function apiGet(AnimeGetByIdRequest $request)
    {
        return AnimeResource::make($this->animeRepository->getById($request->id));
    }
}
