<?php

namespace App\Http\Controllers;

use App\Http\Requests\MangaAddRatingRequest;
use App\Http\Requests\MangaGetByIdRequest;
use App\Http\Resources\MangaResource;
use App\Models\Manga;
use App\Repositories\MangaRepository;
use App\Services\MangaService;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    private MangaRepository $mangaRepository;
    private MangaService $mangaService;

    public function __construct(
        MangaRepository $mangaRepository,
        MangaService $mangaService
    )
    {
        $this->mangaRepository = $mangaRepository;
        $this->mangaService = $mangaService;
    }

    public function apiGet(MangaGetByIdRequest $request)
    {
        return MangaResource::make(
            $this->mangaRepository->getById($request->id)
        );
    }

    public function addRating(MangaAddRatingRequest $request)
    {
        $response = $this->mangaService->addRating($request->id, $request->rating, auth()->id());
        return $this->success($response);
    }
}
