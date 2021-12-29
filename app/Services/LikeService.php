<?php

namespace App\Services;

use App\Models\Like;
use App\Repositories\LikeRepository;

class LikeService
{
    private LikeRepository $likeRepository;

    public function __construct(
        LikeRepository $likeRepository
    )
    {
        $this->likeRepository = $likeRepository;
    }


}
