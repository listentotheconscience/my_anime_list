<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCreatorRequest;
use App\Http\Requests\DeleteMangakaRequest;
use App\Http\Requests\DeleteStudioRequest;
use App\Http\Requests\GetMangakaRequest;
use App\Http\Requests\GetStudioRequest;
use App\Http\Requests\UpdateMangakaRequest;
use App\Http\Requests\UpdateStudioRequest;
use App\Http\Resources\MangakaResource;
use App\Http\Resources\StudioResource;
use App\Repositories\MangakaRepository;
use App\Repositories\StudioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangakaController extends Controller
{
    const IMAGE_PATH = 'mangaka/';

    public function __construct(
        protected MangakaRepository $mangakaRepository,
    ) {}

    public function create(CreateCreatorRequest $request)
    {
        $path = self::IMAGE_PATH . $request->image->getClientOriginalName();
        Storage::disk('public')->put(
            $path,
            file_get_contents($request->image));

        $response = $this->mangakaRepository->create([
            'name' => $request->name,
            'country' => $request->country,
            'image' => $path
        ]);

        return $this->success(MangakaResource::make($response));
    }

    public function delete(DeleteMangakaRequest $request)
    {
        $response = $this->mangakaRepository->deleteById($request->id);

        return $this->success($response);
    }

    public function update(UpdateMangakaRequest $request)
    {
        $response = $this->mangakaRepository->update($request->id, $request->validated());

        return $this->success($response);
    }

    public function get(GetMangakaRequest $request)
    {
        $response = $this->mangakaRepository->getById($request->id);

        return $this->success(MangakaResource::make($response));
    }

    public function list()
    {
        $response = $this->mangakaRepository->all();

        return $this->success(MangakaResource::collection($response));
    }
}
