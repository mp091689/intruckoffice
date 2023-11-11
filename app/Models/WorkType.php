<?php

namespace App\Models;

enum WorkType: string
{
    use EnumTrait;

    case DELIVERY = 'delivery';
    case LOAD = 'load';
    case LAYOVER = 'layover';
    case DETENTION = 'detention';
}
