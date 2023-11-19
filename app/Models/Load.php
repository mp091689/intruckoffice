<?php

namespace App\Models;

use App\Services\Address;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property string $pickup_zip
 * @property string $pickup_country
 * @property string $pickup_state
 * @property string $pickup_city
 * @property string $pickup_lat
 * @property string $pickup_lng
 * @property string $dropoff_zip
 * @property string $dropoff_country
 * @property string $dropoff_state
 * @property string $dropoff_city
 * @property string $dropoff_lat
 * @property string $dropoff_lng
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

    /**
     * TODO: Move this logic to queue
     * @param  Address  $address
     */
    public function fillAddresses(Address $address): void
    {
        $pickup_address = $address->getAddressDetails($this->pickup_zip);

        $this->pickup_country = $pickup_address->country;
        $this->pickup_state = $pickup_address->state;
        $this->pickup_city = $pickup_address->city;
        $this->pickup_lng = $pickup_address->lng;
        $this->pickup_lat = $pickup_address->lat;

        $dropoff_address = $pickup_address;
        if ($this->pickup_zip !== $this->dropoff_zip) {
            $dropoff_address = $address->getAddressDetails($this->dropoff_zip);
        }

        $this->dropoff_country = $dropoff_address->country;
        $this->dropoff_state = $dropoff_address->state;
        $this->dropoff_city = $dropoff_address->city;
        $this->dropoff_lng = $dropoff_address->lng;
        $this->dropoff_lat = $dropoff_address->lat;
    }
}
