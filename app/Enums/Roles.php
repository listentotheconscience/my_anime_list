<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Roles extends Enum
{
    const USER = 'user';
    const MODERATOR = 'moderator';
    const ADMIN = 'admin';
}
