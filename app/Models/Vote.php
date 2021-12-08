<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function votable()
    {
        return $this->morphTo();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'id');
    }

    public function animes()
    {
        return $this->morphedByMany(Anime::class, 'votable');
    }

    public function mangas()
    {
        return $this->morphedByMany(Manga::class, 'votable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
