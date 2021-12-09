<?php

namespace App\Services;

use App\Models\Manga;
use App\Repositories\MangaRepository;
use App\Repositories\VoteRepository;

class MangaService
{
    private MangaRepository $mangaRepository;
    private VoteRepository $voteRepository;

    public function __construct(
        MangaRepository $mangaRepository,
        VoteRepository $voteRepository
    )
    {
        $this->mangaRepository = $mangaRepository;
        $this->voteRepository = $voteRepository;
    }

    public function addRating($id, $rating, $user_id)
    {
        $manga = $this->mangaRepository->getById($id);
        $this->voteRepository->create([
            'rating' => $rating,
            'user_id' => $user_id,
            'votable_type' => Manga::class,
            'votable_id' => $id
        ]);

        $manga->rating = $this->voteRepository->countRatingForVotable(Manga::class, $id);
        $manga->save();

        return [
            'message' => 'Successful'
        ];
    }
}
