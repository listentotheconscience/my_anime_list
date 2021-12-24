<?php

namespace App\Http\Controllers\Anime;

use App\Http\Controllers\CommentController as BaseController;
use App\Http\Requests\CreateAnimeComment;
use App\Http\Requests\GetAnimeCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PaginatedCommentResource;
use App\Models\Anime;
use App\Repositories\AnimeRepository;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use App\Services\PaginationService;

class CommentController extends BaseController
{
    private AnimeRepository $animeRepository;

    public function __construct(
        CommentRepository $commentRepository,
        AnimeRepository $animeRepository,
        CommentService $commentService,
    )
    {
        parent::__construct($commentRepository, $commentService);

        $this->animeRepository = $animeRepository;
    }

    public function create(CreateAnimeComment $request)
    {
        $response = $this->commentService->addComment(Anime::class, $request->id, $request->contents);

        return $this->success(CommentResource::make($response));
    }


    public function get(GetAnimeCommentRequest $request)
    {
        $collection = $this->animeRepository->getById($request->id)->comments()->get();

        $collection = PaginationService::paginate($collection, $request->page);

        return $this->success(PaginatedCommentResource::make($collection));
    }
}
