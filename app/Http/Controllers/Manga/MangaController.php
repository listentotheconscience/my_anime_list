<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use App\Http\Requests\MangaGetByIdRequest;
use App\Http\Resources\MangaResource;
use App\Models\Manga;
use App\Repositories\MangaRepository;

class MangaController extends Controller
{
    private MangaRepository $mangaRepository;

    public function __construct(
        MangaRepository $mangaRepository,
    )
    {
        $this->mangaRepository = $mangaRepository;
    }

    public function get(MangaGetByIdRequest $request)
    {
        return MangaResource::make(
            $this->mangaRepository->getById($request->id)
        );
    }
}
