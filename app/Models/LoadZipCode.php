<?php

namespace App\Models;

use App\Enums\ZipCodeType;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LoadZipCode extends Pivot
{
    protected $fillable = ['id', 'load_id', 'zip_code_id', 'datetime', 'type'];

    protected $casts = [
        'type' => ZipCodeType::class,
        'datetime' => 'datetime',
    ];
}
