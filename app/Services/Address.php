<?php

namespace App\Services;

use App\DTO\AddressDTO;
use App\Models\Setting;

class Address
{
    const REGEX_ZIP_CA = '^(\d{5})$';
    const REGEX_ZIP_US = '^([a-zA-Z]\d[a-zA-Z] \d[a-zA-Z]\d)$';
    const REGEX_ZIP = '/' . self::REGEX_ZIP_US . '|' . self::REGEX_ZIP_CA . '/';

    public function getAddressDetails(string $zip): AddressDTO
    {
        $urlZip = Setting::where('name', 'zip_url')->first();
        $response = \Http::get($urlZip->value, [
            'postal' => $zip,
            'json' => '1',
            'showcountry' => '1'
        ])
            ->json();

        if (isset($response['error'])) {
            return new AddressDTO($zip, '', '', '', '', '');
        }

        return new AddressDTO(
            $zip,
            $response['country'],
            $response['standard']['prov'],
            $response['standard']['city'],
            $response['longt'],
            $response['latt'],
        );
    }
}