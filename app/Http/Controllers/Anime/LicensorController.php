<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCreatorRequest;
use App\Http\Requests\DeleteLicensorRequest;
use App\Http\Requests\GetLicensorRequest;
use App\Http\Requests\UpdateLicensorRequest;
use App\Http\Resources\LicensorResource;
use App\Repositories\LicensorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LicensorController extends Controller
{
    const IMAGE_PATH = 'licensors/';

    public function __construct(
        protected LicensorRepository $licensorRepository,
    ) {}

    public function create(CreateCreatorRequest $request)
    {
        $path = self::IMAGE_PATH . $request->image->getClientOriginalName();
        Storage::disk('public')->put(
            $path,
            file_get_contents($request->image));

        $response = $this->licensorRepository->create([
           'name' => $request->name,
           'country' => $request->country,
           'image' => $path
        ]);

        return $this->success(LicensorResource::make($response));
    }

    public function delete(DeleteLicensorRequest $request)
    {
        $response = $this->licensorRepository->deleteById($request->id);

        return $this->success($response);
    }

    public function update(UpdateLicensorRequest $request)
    {
        $response = $this->licensorRepository->update($request->id, $request->validated());

        return $this->success($response);
    }

    public function get(GetLicensorRequest $request)
    {
        $response = $this->licensorRepository->getById($request->id);

        return $this->success(LicensorResource::make($response));
    }

    public function list()
    {
        $response = $this->licensorRepository->all();

        return $this->success(LicensorResource::collection($response));
    }
}
