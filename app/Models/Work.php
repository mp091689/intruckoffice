<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $id
 * @property int $driver_id
 * @property int $load_id
 * @property WorkType $type
 * @property int $duration
 * @property int quota
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Work extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => WorkType::class,
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

    public function getQuota(): string
    {
        if ($this->type !== WorkType::DELIVERY) {
            return $this->quota;
        }

        $percent = bcdiv($this->quota, 100, 2);
        $workPrice = bcmul($this->theLoad->pricePerMile(), $this->duration, 2);

        return ceil(bcmul($workPrice, $percent, 2));
    }

    public function getDurationLabelName(): string
    {
        return match ($this->type) {
            WorkType::DELIVERY => 'miles',
            default => 'hours',
        };
    }

    public function getQuotaLabelName(): string
    {
        return match ($this->type) {
            WorkType::DELIVERY => '%',
            default => '$',
        };
    }

    public function getInvoiceTitle(): string
    {
        $type = ucfirst($this->type->value);
        $puDate = $this->theLoad->pickup_datetime->format('m/d');
        $doDate = $this->theLoad->dropoff_datetime->format('m/d');

        if ($this->type === WorkType::DELIVERY) {
            return "$puDate-$doDate {$this->theLoad->pickup_state}-{$this->theLoad->dropoff_state} $type";
        }

        return "$puDate {$this->theLoad->pickup_state} $type";
    }
}
