<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends Repository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function findCommentableByIdForCurrentUser(
        $commentable_type, $commentable_id
    )
    {
        return Comment::where('commentable_type', $commentable_type)
            ->where('commentable_id', $commentable_id)
            ->where('user_id', auth()->id())
            ->first();
    }
}
