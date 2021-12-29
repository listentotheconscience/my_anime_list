<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimeGetByIdRequest;
use App\Http\Requests\CreateAnimeRequest;
use App\Http\Requests\DeleteAnimeRequest;
use App\Http\Requests\UpdateAnimeRequest;
use App\Http\Resources\AnimeResource;
use App\Repositories\AnimeRepository;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    const IMAGE_PATH = 'anime/';

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

    public function create(CreateAnimeRequest $request)
    {
        $path = self::IMAGE_PATH . $request->image->getClientOriginalName();
        Storage::disk('public')->put(
            $path,
            file_get_contents($request->image));

        $response = $this->animeRepository->create([
            'name' => $request->name,
            'episodes' => $request->episodes,
            'image' => $path,
            'licensor' => $request->licensor,
            'studio' => $request->studio,
            'producer' => $request->producer,
            'genres' => $request->genres,
            'season' => $request->season,
            'type' => $request->type,
            'status' => $request->status
        ]);

        return $this->success(AnimeResource::make($response));
    }

    public function delete(DeleteAnimeRequest $request)
    {
        $response = $this->animeRepository->deleteById($request->id);

        return $this->success($response);
    }

    public function update(UpdateAnimeRequest $request)
    {
        $response = $this->animeRepository->update($request->id, $request->validated());

        return $this->success($response);
    }

    public function list()
    {
        $response = $this->animeRepository->all();

        return $this->success(AnimeResource::collection($response));
    }
}
