<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class MangaStatus extends Enum
{
    const Ongoing = 'Ongoing';
    const Announced = 'Announced';
    const Finished = 'Finished';
    const Paused = 'Paused';
    const Abandoned = 'Abandoned';
}
