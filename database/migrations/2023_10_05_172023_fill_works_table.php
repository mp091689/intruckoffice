<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $rows = DB::table('loads')->get();

        foreach ($rows as $row) {
            DB::table('works')->insert([
                'driver_id' => $row->driver_id,
                'load_id' => $row->id,
                'distance' => $row->actual_distance,
                'percent' => $row->percentage,
            ]);

            if ($row->driver2_id) {
                DB::table('works')->insert([
                    'driver_id' => $row->driver2_id,
                    'load_id' => $row->id,
                    'distance' => $row->actual_distance,
                    'percent' => $row->percentage2,
                ]);
            }
        }
    }
};
