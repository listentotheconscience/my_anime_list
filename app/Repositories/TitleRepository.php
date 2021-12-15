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

    public function getByIdForCurrentUser($id, $titlable_type)
    {
        return $this->model::where('user_id', auth()->id())->where('titlable_type', $titlable_type)
            ->where('titlable_id', $id)->first();
    }

    public function getTitlableById($titlable_type, $titlable_id)
    {
        $title = Title::where('titlable_type', $titlable_type)->where('titlable_id', $titlable_id)
            ->where('user_id', auth()->id())->first();

        return $title;
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
