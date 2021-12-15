<?php

namespace App\Models;

use App\Traits\Votable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory, Votable;

    protected $guarded = ['id'];

    public function mangakas()
    {
        return $this->belongsTo(Mangaka::class, 'mangaka');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
