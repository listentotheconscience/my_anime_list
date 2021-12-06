<?php

namespace App\Models;

use App\Enums\Countries;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licensor extends Model
{
    use HasFactory, CastsEnums;

    protected $casts = [
        'country' => Countries::class
    ];
}
