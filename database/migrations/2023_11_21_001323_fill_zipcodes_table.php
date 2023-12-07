<?php

use App\Enums\ZipCodeType;
use App\Models\Load;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $loads = Load::all();

        foreach ($loads as $load) {
            $load->zipCodes()->detach();
            $load->zipCodes()->createMany(
                [
                    ['zip' => $load->pickup_zip],
                    ['zip' => $load->dropoff_zip],
                ],
                [
                    ['datetime' => $load->pickup_datetime, 'type' => ZipCodeType::PICKUP->value],
                    ['datetime' => $load->dropoff_datetime, 'type' => ZipCodeType::DELIVERY->value],
                ]
            );
        }
    }
};
