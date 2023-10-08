<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Load extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'dropoff_datetime' => 'datetime',
        'status' => LoadStatus::class,
    ];

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function dispatcher(): BelongsTo
    {
        return $this->belongsTo(Dispatcher::class);
    }

    public function pricePerMile(): string
    {
        if ($this->actual_price == 0 || $this->actual_distance == 0) {
            return 0;
        }

        return bcdiv($this->actual_price, $this->actual_distance, 2);
    }
}
