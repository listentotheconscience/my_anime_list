<?php

namespace App\Http\Controllers;

use App\Http\Resources\TitleResource;
use App\Models\Title;
use App\Repositories\TitleRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    use ApiResponser;

    private TitleRepository $titleRepository;

    public function __construct(
        TitleRepository $titleRepository
    )
    {
        $this->titleRepository = $titleRepository;
    }

    public function getListForMe()
    {
        $data = $this->titleRepository->getAllForCurrentUser();

        return $this->success(TitleResource::collection($data));
    }


}
