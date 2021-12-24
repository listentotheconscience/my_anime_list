<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Http\Requests\UnfollowRequest;
use App\Http\Resources\FollowerResource;
use App\Models\Follower;
use App\Repositories\FollowerRepository;
use App\Services\FollowerService;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    private FollowerService $followerService;

    public function __construct(
        FollowerService $followerService,
    )
    {
        $this->followerService = $followerService;
    }

    public function index()
    {
        $list = $this->followerService->list();
        return $this->success(FollowerResource::collection($list), $list->count());
    }

    public function create(FollowRequest $request)
    {
        $response = $this->followerService->create($request);

        return $this->success(new FollowerResource($response));
    }

    public function delete(UnfollowRequest $request)
    {
        $response = $this->followerService->delete($request);

        return $this->success($response);
    }
}
