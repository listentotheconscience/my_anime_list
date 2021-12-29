<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCreatorRequest;
use App\Http\Requests\DeleteStudioRequest;
use App\Http\Requests\GetStudioRequest;
use App\Http\Requests\UpdateStudioRequest;
use App\Http\Resources\StudioResource;
use App\Repositories\StudioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    const IMAGE_PATH = 'studios/';

    public function __construct(
        protected StudioRepository $studioRepository,
    ) {}

    public function create(CreateCreatorRequest $request)
    {
        $path = self::IMAGE_PATH . $request->image->getClientOriginalName();
        Storage::disk('public')->put(
            $path,
            file_get_contents($request->image));

        $response = $this->studioRepository->create([
            'name' => $request->name,
            'country' => $request->country,
            'image' => $path
        ]);

        return $this->success(StudioResource::make($response));
    }

    public function delete(DeleteStudioRequest $request)
    {
        $response = $this->studioRepository->deleteById($request->id);

        return $this->success($response);
    }

    public function update(UpdateStudioRequest $request)
    {
        $response = $this->studioRepository->update($request->id, $request->validated());

        return $this->success($response);
    }

    public function get(GetStudioRequest $request)
    {
        $response = $this->studioRepository->getById($request->id);

        return $this->success(StudioResource::make($response));
    }

    public function list()
    {
        $response = $this->studioRepository->all();

        return $this->success(StudioResource::collection($response));
    }
}
