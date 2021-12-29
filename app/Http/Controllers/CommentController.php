<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteComment;
use App\Http\Requests\LikeRequest;
use App\Http\Requests\UpdateComment;
use App\Models\Comment;
use App\Models\Like;
use App\Repositories\CommentRepository;
use App\Repositories\LikeRepository;
use App\Services\CommentService;
use App\Services\LikeService;

class CommentController extends Controller
{
    protected CommentRepository $commentRepository;
    protected CommentService $commentService;
    protected LikeRepository $likeRepository;
    protected LikeService $likeService;

    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService,
        LikeService $likeService,
        LikeRepository $likeRepository
    )
    {
        $this->commentService = $commentService;
        $this->commentRepository = $commentRepository;
        $this->likeService = $likeService;
        $this->likeRepository = $likeRepository;
    }

    public function delete(DeleteComment $request)
    {
        $response = $this->commentService->deleteComment($request->id);

        return $this->success($response);
    }

    public function update(UpdateComment $request)
    {
        $response = $this->commentService->updateComment($request->id, $request->contents);

        return $this->success($response);
    }

    public function like(LikeRequest $request)
    {
        $like = $this->likeRepository->getExistingLikeForCurrentUser($request->id);

        if (is_null($like)) {
            $this->likeRepository->create([
                'comment_id' => $request->id,
                'user_id' => auth()->id()
            ]);
            $msg = 'Successful';
        } else {
            if (is_null($like->deleted_at)) {
                $like->delete();
                $msg = 'Deleted';
            } else {
                $like->restore();
                $msg = 'Successful';
            }
        }

        return $this->success(null, message: $msg);
    }
}
