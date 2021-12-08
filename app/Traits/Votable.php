<?php

namespace App\Traits;

use App\Models\Vote;

trait Votable
{
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
