<?php

namespace App\Services;

use App\Models\Title;
use App\Repositories\TitleRepository;

class TitleService
{
    private TitleRepository $titleRepository;

    public function __construct(
        TitleRepository $titleRepository
    )
    {
        $this->titleRepository = $titleRepository;
    }

    public function addTitlableToList(
        $titlable_type,
        $titlable_id,
        $section,
        $user_id
    )
    {
        $data = $this->titleRepository->create([
            'user_id' => $user_id,
            'titlable_type' => $titlable_type,
            'titlable_id' => $titlable_id,
            'status' => $section
        ]);

        return [
            'object' => $data
        ];
    }

    public function deleteTitlable($titlable_type, $titlable_id)
    {
        $title = $this->titleRepository->getByIdForCurrentUser($titlable_id, $titlable_type);

        return $title->delete();
    }

    public function updateStatus($titable_type, $titlable_id, $section)
    {
        $title = $this->titleRepository->getByIdForCurrentUser($titlable_id, $titable_type);

        $title->status = $section;

        return $title->save();
    }
}
