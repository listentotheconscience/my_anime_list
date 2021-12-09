<?php

namespace App\Repositories;

use App\Models\Title;

class TitleRepository extends Repository
{
    public function __construct(Title $model)
    {
        parent::__construct($model);
    }
}
