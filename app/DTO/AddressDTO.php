<?php

namespace App\DTO;

class AddressDTO
{
    public function __construct(
        public string $zip,
        public string $country,
        public string $state,
        public string $city,
        public string $lng,
        public string $lat,
    ) {
    }
}