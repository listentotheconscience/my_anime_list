<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function anime()
    {
        return $this->morphedByMany(Anime::class, 'commentable');
    }

    public function manga()
    {
        return $this->morphedByMany(Manga::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
