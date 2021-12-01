<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $casts = [
        'genres' => AsArrayObject::class,
    ];

    public function licensors()
    {
        return $this->belongsToMany(Licensor::class);
    }

    public function producers()
    {
        return $this->belongsToMany(Producer::class);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }
}
