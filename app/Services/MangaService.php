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

    public function delRating($id, $user_id)
    {
        $manga = $this->mangaRepository->getById($id);

        $vote = $this->voteRepository
            ->getVotableById(Manga::class, $id)
            ->where('user_id', $user_id)
            ->first();

        $success = $this->voteRepository->deleteVotable($vote);

        if ($success) {
            $manga->rating = $this->voteRepository->countRatingForVotable(Manga::class, $id);
            return [
                'message' => 'Deleted'
            ];
        }

        return [
            'message' => 'Cannot find vote',
            'code' => 404
        ];
    }

    public function updateRating($id, $rating_id, $rating)
    {
        $manga = $this->mangaRepository->getById($id);

        $this->voteRepository->update($rating_id, [
            'rating' => $rating
        ]);

        $manga->rating = $this->voteRepository->countRatingForVotable(Manga::class, $id);
        $manga->save();

        return [
            'message' => 'Successful'
        ];
    }
}
