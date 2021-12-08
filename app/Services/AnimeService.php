<?php

namespace App\Services;

use App\Models\Anime;
use App\Repositories\AnimeRepository;
use App\Repositories\VoteRepository;

class AnimeService
{
    private $animeRepository;
    private $voteRepository;

    public function __construct(
        AnimeRepository $animeRepository,
        VoteRepository $voteRepository
    )
    {
        $this->animeRepository = $animeRepository;
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
    }
}
