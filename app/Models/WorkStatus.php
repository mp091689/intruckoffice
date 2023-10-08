<?php

namespace App\Models;

enum WorkStatus: string
{
    use EnumTrait;

    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case INVOICED = 'invoiced';
}
