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
use App\Models\Title;
use App\Repositories\AnimeRepository;
use App\Repositories\MangaRepository;
use App\Repositories\TitleRepository;
use App\Services\TitleService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    use ApiResponser;

    private TitleRepository $titleRepository;
    private AnimeRepository $animeRepository;
    private MangaRepository $mangaRepository;
    private TitleService $titleService;

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

    public function getListForMe()
    {
        $data = $this->titleRepository->getAllForCurrentUser();

        return $this->success(TitleResource::collection($data));
    }

    public function addAnimeToList(AddAnimeToListRequest $request)
    {
        $anime = $this->animeRepository->getById($request->id);
        if ($anime) {
            return $this->error('This anime in list already', 406);
        }

        $title = $this->titleService->addTitlableToList(
            Anime::class, $request->id, $request->section, auth()->id());

        return $this->success($title);
    }

    public function addMangaToList(AddMangaToListRequest $request)
    {
        $manga = $this->mangaRepository->getById($request->id);
        if ($manga) {
            return $this->error('This manga in list already', 406);
        }

        $title = $this->titleService->addTitlableToList(
            Manga::class, $request->id, $request->section, auth()->id());

        return $this->success($title);
    }

    public function delAnimeFromList(DelAnimeFromListRequest $request)
    {
        //TODO: implement this
    }

    public function delMangaFromList(DelMangaFromListRequest $request)
    {
        //TODO: implement this
    }

    public function updateAnimeStatus(UpdateAnimeStatusRequest $request)
    {
        //TODO: implement this
    }

    public function updateMangaStatus(UpdateMangaStatusRequest $request)
    {
        //TODO: implement this
    }
}
