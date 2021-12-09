<?php

namespace App\Repositories;

use App\Models\Vote;

class VoteRepository extends Repository
{
    public function __construct(
        Vote $model,
    )
    {
        parent::__construct($model);
    }

    public function selectForCurrentUser($user_id)
    {
        return $this->model::where('user_id', $user_id)->get();
    }

    public function getVotableById($votable_type, $votable_id)
    {
        return $this->model::where('votable_type', $votable_type)
            ->where('votable_id', $votable_id)->get();
    }

    public function countRatingForVotable($votable_type, $votable_id)
    {
        return $this->getVotableById($votable_type, $votable_id)->avg('rating');
    }
}
