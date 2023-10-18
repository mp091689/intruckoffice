<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Work extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => WorkStatus::class,
    ];

    protected $guarded = [];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function theLoad(): BelongsTo
    {
        return $this->belongsTo(Load::class, 'load_id');
    }

    public function price(): string
    {
        $percent = bcdiv($this->percent, 100, 2);
        $workPrice = bcmul($this->theLoad->pricePerMile(), $this->distance, 2);

        return ceil(bcmul($workPrice, $percent, 2));
    }
}
