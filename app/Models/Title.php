<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    public function titlable()
    {
        return $this->morphTo();
    }

    public function animes()
    {
        return $this->morphedByMany(Anime::class, 'titlable');
    }

    public function mangas()
    {
        return $this->morphedByMany(Manga::class, 'titlable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
