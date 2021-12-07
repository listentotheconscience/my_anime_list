<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    public function mangakas()
    {
        return $this->belongsTo(Mangaka::class, 'mangaka');
    }
}
