<?php

namespace App\Models;

use App\Traits\Votable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory, Votable;

    protected $guarded = ['id'];

    protected $casts = [
        'genres' => 'array',
    ];

    public function licensors()
    {
        return $this->belongsTo(Licensor::class, 'licensor');
    }

    public function producers()
    {
        return $this->belongsTo(Producer::class, 'producer');
    }

    public function studios()
    {
        return $this->belongsTo(Studio::class, 'studio');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
