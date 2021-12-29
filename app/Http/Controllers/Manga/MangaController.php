<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAnimeRequest;
use App\Http\Requests\CreateMangaRequest;
use App\Http\Requests\DeleteMangaRequest;
use App\Http\Requests\MangaGetByIdRequest;
use App\Http\Requests\UpdateMangaRequest;
use App\Http\Resources\MangaResource;
use App\Models\Manga;
use App\Repositories\MangaRepository;

class MangaController extends Controller
{
    const IMAGE_PATH = 'manga/';

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

    public function create(CreateMangaRequest $request)
    {
        $path = self::IMAGE_PATH . $request->image->getClientOriginalName();
        Storage::disk('public')->put(
            $path,
            file_get_contents($request->image));

        $response = $this->mangaRepository->create([
            'name' => $request->name,
            'chapters' => $request->chapters,
            'image' => $path,
            'mangaka' => $request->mangaka,
            'genres' => $request->genres,
            'year' => $request->year,
            'type' => $request->type,
            'status' => $request->status
        ]);

        return $this->success(MangaResource::make($response));
    }

    public function delete(DeleteMangaRequest $request)
    {
        $response = $this->mangaRepository->deleteById($request->id);

        return $this->success($response);
    }

    public function update(UpdateMangaRequest $request)
    {
        $response = $this->mangaRepository->update($request->id, $request->validated());

        return $this->success($response);
    }

    public function list()
    {
        $response = $this->mangaRepository->all();

        return $this->success(MangaResource::collection($response));
    }
}
