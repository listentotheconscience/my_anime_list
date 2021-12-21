<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    private CommentRepository $commentRepository;

    public function __construct(
        CommentRepository $commentRepository
    )
    {
        $this->commentRepository=  $commentRepository;
    }

    public function addComment($commentable_type, $commentable_id, $contents)
    {
        return $this->commentRepository->create([
            'commentable_type' => $commentable_type,
            'commentable_id'   => $commentable_id,
            'contents'          => $contents,
            'user_id'          => auth()->id()
        ]);
    }

    public function deleteComment($comment_id)
    {;
        return $this->commentRepository->deleteById($comment_id);
    }

    public function updateComment($id, $contents)
    {
        return $this->commentRepository->update($id, [
            'contents' => $contents
        ]);
    }
}
