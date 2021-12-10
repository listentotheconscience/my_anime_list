<?php

namespace App\Repositories;

use App\Models\Title;

class TitleRepository extends Repository
{
    public function __construct(Title $model)
    {
        parent::__construct($model);
    }

    public function getAllForCurrentUser()
    {
        return $this->model::where('user_id', auth()->id())->get();
    }

    public function getWithStatusForCurrentUser($status)
    {
        return $this->model::where('user_id', auth()->id())
            ->where('status', $status)
            ->get();
    }

    public function getAllForUser($user)
    {
        return $this->model::where('user_id', $user)->get();
    }
}
