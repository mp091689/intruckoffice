<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\ZipCode;
use Http;

class ZipFinder
{
    const REGEX_ZIP_CA = '^(\d{5})$';
    const REGEX_ZIP_US = '^([a-zA-Z]\d[a-zA-Z] \d[a-zA-Z]\d)$';
    const REGEX_ZIP = '/' . self::REGEX_ZIP_US . '|' . self::REGEX_ZIP_CA . '/';

    public function getZipCodeInfo(string $zip): array
    {
        $result = ['zip' => $zip];
        $urlZip = Setting::where('name', 'zip_url')->first();
        try {
            $response = Http::get($urlZip->value, [
                'postal' => $zip,
                'json' => '1',
                'showcountry' => '1',
            ])
                ->json();
        } catch (\Exception $e) {
            return $result;
        }

        if (isset($response['error'])) {
            return $result;
        }

        return [
            'zip' => $zip,
            'country' => $response['country'],
            'state' => $response['standard']['prov'],
            'city' => $response['standard']['city'],
            'lng' => $response['longt'],
            'lat' => $response['latt'],
        ];
    }
}