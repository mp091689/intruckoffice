<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $pickup_address
 * @property DateTime $pickup_datetime
 * @property string $dropoff_address
 * @property DateTime $dropoff_datetime
 * @property int $dispatcher_id
 * @property string $estimated_price
 * @property int $estimated_distance
 * @property string $actual_price
 * @property int $actual_distance
 * @property string $description
 * @property string $status
 */
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

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(
            Invoice::class,
            'works',
            'load_id',
            'invoice_id'
        )->distinct();
    }
}
