<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TitleStatus extends Enum
{
    const Watched = 'Watched';
    const Favorite = 'Favorite';
    const Watching = 'Watching';
    const Planned = 'Planned';
    const Dropped = 'Dropped';
}
