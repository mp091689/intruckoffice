<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $value
 */
class Setting extends Model
{
    use HasFactory;

    public static function get(string $name): string
    {
        return static::where('name', $name)->firstOrFail()->value;
    }
}
