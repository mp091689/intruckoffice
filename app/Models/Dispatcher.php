<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer id
 */
class Dispatcher extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loads(): HasMany
    {
        return $this->hasMany(Load::class);
    }
}
