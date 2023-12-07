<?php

namespace App\Models;

use App\Services\ZipFinder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function newInstance($attributes = [], $exists = false): ZipCode
    {
        if (!count($attributes)) {
            return parent::newInstance($attributes, $exists);
        }

        $i = self::where('zip', $attributes['zip'])->first();
        if (!$i?->exists) {
            $i = parent::newInstance((new ZipFinder())->getZipCodeInfo($attributes['zip']), $exists);
            $i->save();
        }

        return $i;
    }
}
