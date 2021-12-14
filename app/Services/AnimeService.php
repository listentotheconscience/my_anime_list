<?php

namespace App\Services;

use App\Models\Anime;
use App\Repositories\AnimeRepository;
use App\Repositories\VoteRepository;

class AnimeService
{
    private AnimeRepository $animeRepository;
    private VoteRepository $voteRepository;

    public function __construct(
        AnimeRepository $animeRepository,
        VoteRepository $voteRepository
    )
    {
        $this->animeRepository = $animeRepository;
        $this->voteRepository = $voteRepository;
    }

    public function addRating($id, $rating, $user_id)
    {
        $anime = $this->animeRepository->getById($id);
        $this->voteRepository->create([
            'rating' => $rating,
            'user_id' => $user_id,
            'votable_type' => Anime::class,
            'votable_id' => $id
        ]);

        $anime->rating = $this->voteRepository->countRatingForVotable(Anime::class, $id);
        $anime->save();

        return [
            'message' => 'Successful'
        ];
    }

    public function delRating($id, $user_id)
    {
        $anime = $this->animeRepository->getById($id);

        $vote = $this->voteRepository
            ->getVotableById(Anime::class, $id)
            ->where('user_id', $user_id)
            ->first();

        $success = $this->voteRepository->deleteVotable($vote);

        if ($success) {
            $anime->rating = $this->voteRepository->countRatingForVotable(Anime::class, $id);
            return [
                'message' => 'Deleted'
            ];
        }

        return [
            'message' => 'Cannot find vote',
            'code' => 404
        ];
    }
}
