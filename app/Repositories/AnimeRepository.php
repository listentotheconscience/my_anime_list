<?php

namespace App\Repositories;

use App\Models\Anime;

class AnimeRepository extends Repository
{
    public function __construct(Anime $model)
    {
        parent::__construct($model);
    }
}
