<?php

namespace App\Services;

use App\Http\Requests\FollowRequest;
use App\Http\Requests\UnfollowRequest;
use App\Repositories\FollowerRepository;

class FollowerService
{
    private FollowerRepository $followerRepository;

    public function __construct(
        FollowerRepository $followerRepository
    )
    {
        $this->followerRepository = $followerRepository;
    }

    public function create(FollowRequest $request)
    {
        return $this->followerRepository->create([
           'follower_id' => $request->follower_id,
           'followed_id' => $request->followed_id
        ]);
    }

    public function delete(UnfollowRequest $request)
    {
        return $this->followerRepository->delete($request->followed_id);
    }

    public function list(bool $searchFollows)
    {
        return $searchFollows ?
               $this->followerRepository->getAllFollowsForCurrentUser() :
               $this->followerRepository->getAllFollowersForCurrentUser();
    }
}
