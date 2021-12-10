<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class TitleStatus extends Enum
{
    const Watched = 'Watched';
    const Favorite = 'Favorite';
    const Watching = 'Watching';
    const Planned = 'Planned';
    const Dropped = 'Dropped';
}
