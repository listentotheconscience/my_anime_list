<?php

namespace App\Models;

use App\Enums\Countries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mangaka extends Model
{
    use HasFactory;

    protected $casts = [
        'country' => Countries::class
    ];
}
