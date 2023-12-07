<?php

namespace App\Enums;

enum LoadStatus: string
{
    use EnumTrait;

    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
