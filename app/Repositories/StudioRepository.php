<?php

namespace App\Repositories;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Model;

class StudioRepository extends Repository
{

    public function __construct(Studio $model)
    {
        parent::__construct($model);
    }
}
