<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository extends Repository
{
    public function __construct(Like $model)
    {
        parent::__construct($model);
    }

    public function getExistingLikeForCurrentUser($comment_id)
    {
        return $this->model::whereCommentId($comment_id)->whereUserId(auth()->id())->first();
    }
}
