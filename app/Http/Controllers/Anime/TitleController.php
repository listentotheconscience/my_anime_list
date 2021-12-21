<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\TitleController as BaseController;
use App\Http\Requests\AddAnimeToListRequest;
use App\Http\Requests\DelAnimeFromListRequest;
use App\Http\Requests\UpdateAnimeStatusRequest;
use App\Models\Anime;
use App\Repositories\AnimeRepository;
use App\Repositories\MangaRepository;
use App\Repositories\TitleRepository;
use App\Services\TitleService;

class TitleController extends BaseController
{
    public function __construct(
        TitleRepository $titleRepository,
        AnimeRepository $animeRepository,
        MangaRepository $mangaRepository,
        TitleService $titleService)
    {
        parent::__construct($titleRepository, $animeRepository, $mangaRepository, $titleService);
    }

    public function create(AddAnimeToListRequest $request)
    {
        $anime = $this->titleRepository->getByIdForCurrentUser($request->id, Anime::class);
        if ($anime) {
            return $this->error('This anime in list already', 406);
        }

        $title = $this->titleService->addTitlableToList(
            Anime::class, $request->id, $request->section, auth()->id());

        return $this->success($title);
    }

    public function delete(DelAnimeFromListRequest $request)
    {
        $response = $this->titleService->deleteTitlable(Anime::class, $request->id);

        return $this->success($response);
    }

    public function update(UpdateAnimeStatusRequest $request)
    {
        $response = $this->titleService->updateStatus(Anime::class, $request->id, $request->section);

        return $this->success($response);
    }
}
