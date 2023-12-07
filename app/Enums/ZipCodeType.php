<?php

namespace App\Enums;

enum ZipCodeType: string
{
    use EnumTrait;

    case START = 'start';
    case PICKUP = 'pickup';
    case DELIVERY = 'delivery';
}
