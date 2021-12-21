<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteComment;
use App\Http\Requests\UpdateComment;
use App\Repositories\CommentRepository;
use App\Services\CommentService;

abstract class CommentController extends Controller
{
    protected CommentRepository $commentRepository;
    protected CommentService $commentService;

    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService
    )
    {
        $this->commentService = $commentService;
        $this->commentRepository = $commentRepository;
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
}
