<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    const Ongoing = 'Ongoing';
    const Announced = 'Announced';
    const Finished = 'Finished';
}
