<?php

namespace App\Http\Controllers\Manga;

use App\Http\Controllers\CommentController as BaseController;
use App\Http\Requests\CreateMangaComment;
use App\Http\Requests\GetMangaCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PaginatedCommentResource;
use App\Repositories\CommentRepository;
use App\Repositories\MangaRepository;
use App\Services\CommentService;
use App\Services\PaginationService;

class CommentController extends BaseController
{
    protected MangaRepository $mangaRepository;

    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService,
        MangaRepository $mangaRepository
    )
    {
        parent::__construct($commentRepository, $commentService);

        $this->mangaRepository = $mangaRepository;
    }


    public function create(CreateMangaComment $request)
    {
        $response = $this->commentService->addComment(Manga::class, $request->id, $request->contents);

        return $this->success(CommentResource::make($response));
    }

    public function get(GetMangaCommentRequest $request)
    {
        $collection = $this->mangaRepository->getById($request->id)->comments();

        $collection = PaginationService::paginate($collection, $request->page);

        return $this->success(PaginatedCommentResource::make($collection));
    }
}
