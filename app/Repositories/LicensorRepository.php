<?php

namespace App\Repositories;

use App\Models\Licensor;
use Illuminate\Database\Eloquent\Model;

class LicensorRepository extends Repository
{
    public function __construct(Licensor $model)
    {
        parent::__construct($model);
    }
}
