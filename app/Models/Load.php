<?php

namespace App\Models;

use App\Enums\LoadStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Load extends Model
{
    use HasFactory;

    protected $guarded = ['zipCodes'];

    protected $casts = [
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

    public function zipCodes(): BelongsToMany
    {
        return $this->belongsToMany(ZipCode::class)
            ->using(LoadZipCode::class)
            ->withPivot('id', 'type', 'datetime')
            ->orderByPivot('datetime');
    }

    public function getFrontZipItems(): array
    {
        $zipItems = [];
        foreach ($this->zipCodes as $zipCode) {
            $zipItems[] = [
                'zip' => $zipCode->zip,
                'id' => $zipCode->pivot->id,
                'type' => $zipCode->pivot->type->value,
                'datetime' => $zipCode->pivot->datetime->format('Y-m-d\TH:i:s'),
            ];
        }

        return $zipItems;
    }
}
