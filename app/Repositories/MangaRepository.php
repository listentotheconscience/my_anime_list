<?php

namespace App\Repositories;

use App\Models\Manga;

class MangaRepository extends Repository
{
    public function __construct(Manga $model)
    {
        parent::__construct($model);
    }
}
