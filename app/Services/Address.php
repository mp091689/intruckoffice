<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\ZipCode;

class Address
{
    const REGEX_ZIP_CA = '^(\d{5})$';
    const REGEX_ZIP_US = '^([a-zA-Z]\d[a-zA-Z] \d[a-zA-Z]\d)$';
    const REGEX_ZIP = '/' . self::REGEX_ZIP_US . '|' . self::REGEX_ZIP_CA . '/';

    public function getZipCode(string $zip): ZipCode
    {
        $urlZip = Setting::where('name', 'zip_url')->first();

        $zipCode = ZipCode::firstOrNew(['zip' => $zip]);

        if ($zipCode->exists) {
            return $zipCode;
        }

        $response = \Http::get($urlZip->value, [
            'postal' => $zip,
            'json' => '1',
            'showcountry' => '1',
        ])
            ->json();

        if (isset($response['error'])) {
            return $zipCode;
        }

        $zipCode->country = $response['country'];
        $zipCode->state = $response['standard']['prov'];
        $zipCode->city = $response['standard']['city'];
        $zipCode->lng = $response['longt'];
        $zipCode->lat = $response['latt'];

        $zipCode->save();

        return $zipCode;
    }
}