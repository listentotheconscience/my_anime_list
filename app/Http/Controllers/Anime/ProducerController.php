<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCreatorRequest;
use App\Http\Requests\DeleteProducerRequest;
use App\Http\Requests\GetProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Http\Resources\ProducerResource;
use App\Repositories\ProducerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProducerController extends Controller
{
    const IMAGE_PATH = 'producers/';

    public function __construct(
        protected ProducerRepository $producerRepository,
    ) {}

    public function create(CreateCreatorRequest $request)
    {
        $path = self::IMAGE_PATH . $request->image->getClientOriginalName();
        Storage::disk('public')->put(
            $path,
            file_get_contents($request->image));

        $response = $this->producerRepository->create([
            'name' => $request->name,
            'country' => $request->country,
            'image' => $path
        ]);

        return $this->success(ProducerResource::make($response));
    }

    public function delete(DeleteProducerRequest $request)
    {
        $response = $this->producerRepository->deleteById($request->id);

        return $this->success($response);
    }

    public function update(UpdateProducerRequest $request)
    {
        $response = $this->producerRepository->update($request->id, $request->validated());

        return $this->success($response);
    }

    public function get(GetProducerRequest $request)
    {
        $response = $this->producerRepository->getById($request->id);

        return $this->success(ProducerResource::make($response));
    }

    public function list()
    {
        $response = $this->producerRepository->all();

        return $this->success(ProducerResource::collection($response));
    }
}
