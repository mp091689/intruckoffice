<?php

namespace App\Models;

use App\Enums\WorkType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        $puDate = $this->theLoad->zipCodes->first()?->pivot->datetime->format('m/d') ?? $this->theLoad->created_at->format('m/d');
        $doDate = $this->theLoad->zipCodes->last()?->pivot->datetime->format('m/d') ?? $this->theLoad->created_at->format('m/d');

        $route = '';
        foreach ($this->theLoad->zipCodes as $zipCode) {
            $route .= $zipCode->state . '-';
        }
        $route = trim($route, '-');

        if ($this->type === WorkType::DELIVERY) {
            return "$puDate-$doDate $route $type";
        }

        return "$puDate $type";
    }
}
