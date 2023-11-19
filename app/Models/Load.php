<?php

namespace App\Models;

use App\Services\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(
            Invoice::class,
            'works',
            'load_id',
            'invoice_id'
        )->distinct();
    }

    /**
     * @param  Address  $address
     */
    public function fillAddresses(Address $address): void
    {
        $pickupZipCode = $address->getZipCode($this->pickup_zip);

        $this->pickup_country = $pickupZipCode->country;
        $this->pickup_state = $pickupZipCode->state;
        $this->pickup_city = $pickupZipCode->city;
        $this->pickup_lng = $pickupZipCode->lng;
        $this->pickup_lat = $pickupZipCode->lat;

        $deliveryZipCode = $pickupZipCode;
        if ($this->pickup_zip !== $this->dropoff_zip) {
            $deliveryZipCode = $address->getZipCode($this->dropoff_zip);
        }

        $this->dropoff_country = $deliveryZipCode->country;
        $this->dropoff_state = $deliveryZipCode->state;
        $this->dropoff_city = $deliveryZipCode->city;
        $this->dropoff_lng = $deliveryZipCode->lng;
        $this->dropoff_lat = $deliveryZipCode->lat;
    }
}
