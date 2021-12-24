<?php

namespace App\Repositories;

use App\Models\Follower;

class FollowerRepository extends Repository
{
    public function __construct(Follower $model)
    {
        parent::__construct($model);
    }

    public function delete($id)
    {
        $item = $this->model::where('follower_id', auth()->id())
            ->where('followed_id', $id)->first();

        return $item->delete();
    }

    public function getAllFollowsForCurrentUser()
    {
        return $this->model::where('follower_id', auth()->id())->get();
    }

    public function getAllFollowersForCurrentUser()
    {
        return $this->model::where('followed_id', auth()->id())->get();
    }
}
