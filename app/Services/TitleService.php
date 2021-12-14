<?php

namespace App\Services;

use App\Models\Title;

class TitleService
{
    public function addTitlableToList(
        $titlable_type,
        $titlable_id,
        $section,
        $user_id
    )
    {
        $title = Title::create([
            'user_id' => $user_id,
            'titlable_type' => $titlable_type,
            'titlable_id' => $titlable_id,
            'status' => $section
        ]);

        return [
            'message' => 'Success'
        ];
    }
}
