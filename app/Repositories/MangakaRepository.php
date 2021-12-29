<?php

namespace App\Repositories;

use App\Models\Mangaka;

class MangakaRepository extends Repository
{
    public function __construct(Mangaka $model)
    {
        parent::__construct($model);
    }
}
