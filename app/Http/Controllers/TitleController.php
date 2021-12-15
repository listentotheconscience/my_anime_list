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
        $anime = $this->titleRepository->getByIdForCurrentUser($request->id, Anime::class);
        if ($anime) {
            return $this->error('This anime in list already', 406);
        }

        $title = $this->titleService->addTitlableToList(
            Anime::class, $request->id, $request->section, auth()->id());

        return $this->success($title);
    }

    public function addMangaToList(AddMangaToListRequest $request)
    {
        $manga = $this->titleRepository->getByIdForCurrentUser($request->id, Manga::class);
        if ($manga) {
            return $this->error('This manga in list already', 406);
        }

        $title = $this->titleService->addTitlableToList(
            Manga::class, $request->id, $request->section, auth()->id());

        return $this->success($title);
    }

    public function delAnimeFromList(DelAnimeFromListRequest $request)
    {
        $response = $this->titleService->deleteTitlable(Anime::class, $request->id);

        return $this->success($response);
    }

    public function delMangaFromList(DelMangaFromListRequest $request)
    {
        $response = $this->titleService->deleteTitlable(Manga::class, $request->id);

        return $this->success($response);
    }

    public function updateAnimeStatus(UpdateAnimeStatusRequest $request)
    {
        $response = $this->titleService->updateStatus(Anime::class, $request->id, $request->section);

        return $this->success($response);
    }

    public function updateMangaStatus(UpdateMangaStatusRequest $request)
    {
        $response = $this->titleService->updateStatus(Manga::class, $request->id, $request->section);

        return $this->success($response);
    }
}
