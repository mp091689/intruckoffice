<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
