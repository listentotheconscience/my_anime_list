<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\TitleController as BaseController;
use App\Http\Requests\AddMangaToListRequest;
use App\Http\Requests\DelMangaFromListRequest;
use App\Http\Requests\UpdateMangaStatusRequest;
use App\Models\Manga;
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
        TitleService $titleService
    )
    {
        parent::__construct($titleRepository, $animeRepository, $mangaRepository, $titleService);
    }

    public function create(AddMangaToListRequest $request)
    {
        $manga = $this->titleRepository->getByIdForCurrentUser($request->id, Manga::class);
        if ($manga) {
            return $this->error('This manga in list already', 406);
        }

        $title = $this->titleService->addTitlableToList(
            Manga::class, $request->id, $request->section, auth()->id());

        return $this->success($title);
    }



    public function delete(DelMangaFromListRequest $request)
    {
        $response = $this->titleService->deleteTitlable(Manga::class, $request->id);

        return $this->success($response);
    }



    public function update(UpdateMangaStatusRequest $request)
    {
        $response = $this->titleService->updateStatus(Manga::class, $request->id, $request->section);

        return $this->success($response);
    }
}
