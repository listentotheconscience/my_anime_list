<?php

namespace App\Repositories;

use App\Models\Producer;
use Illuminate\Database\Eloquent\Model;

class ProducerRepository extends Repository
{

    public function __construct(Producer $model)
    {
        parent::__construct($model);
    }
}
