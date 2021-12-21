<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAnimeToListRequest;
use App\Http\Requests\AddMangaToListRequest;
use App\Http\Requests\DelAnimeFromListRequest;
use App\Http\Requests\DelMangaFromListRequest;
use App\Http\Requests\UpdateAnimeStatusRequest;
use App\Http\Requests\UpdateMangaStatusRequest;
use App\Http\Resources\TitleResource;
use App\Models\Anime;
use App\Models\Manga;
use App\Repositories\AnimeRepository;
use App\Repositories\MangaRepository;
use App\Repositories\TitleRepository;
use App\Services\TitleService;
use App\Traits\ApiResponser;

class TitleController extends Controller
{
    use ApiResponser;

    protected TitleRepository $titleRepository;
    protected AnimeRepository $animeRepository;
    protected MangaRepository $mangaRepository;
    protected TitleService $titleService;

    public function __construct(
        TitleRepository $titleRepository,
        AnimeRepository $animeRepository,
        MangaRepository $mangaRepository,
        TitleService $titleService
    )
    {
        $this->titleRepository = $titleRepository;
        $this->animeRepository = $animeRepository;
        $this->mangaRepository = $mangaRepository;
        $this->titleService = $titleService;
    }

    public function list()
    {
        $data = $this->titleRepository->getAllForCurrentUser();

        return $this->success(TitleResource::collection($data));
    }
}
