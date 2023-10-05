<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Load extends Model
{
    use HasFactory;

    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';
    const STATUS_CANCELED = 'canceled';

    const STATUSES = [
        self::STATUS_IN_PROGRESS => 'In Progress',
        self::STATUS_DONE => 'Done',
        self::STATUS_CANCELED => 'Canceled',
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'dropoff_datetime' => 'datetime',
    ];

    protected $guarded = [];

    public function getDriverSalary(): string
    {
        return $this->price * ($this->percentage / 100);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function driver2(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function getDriver2Salary(): string
    {
        return $this->price * ($this->percentage2 / 100);
    }

    public function dispatcher(): BelongsTo
    {
        return $this->belongsTo(Dispatcher::class);
    }
}
