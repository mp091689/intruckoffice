<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loads', function (Blueprint $table) {
            $table->dropColumn('pickup_address');
            $table->dropColumn('pickup_datetime');
            $table->dropColumn('dropoff_address');
            $table->dropColumn('dropoff_datetime');
            $table->dropColumn('pickup_zip');
            $table->dropColumn('pickup_country');
            $table->dropColumn('pickup_state');
            $table->dropColumn('pickup_city');
            $table->dropColumn('pickup_lat');
            $table->dropColumn('pickup_lng');
            $table->dropColumn('dropoff_zip');
            $table->dropColumn('dropoff_country');
            $table->dropColumn('dropoff_state');
            $table->dropColumn('dropoff_city');
            $table->dropColumn('dropoff_lat');
            $table->dropColumn('dropoff_lng');
        });
    }
};
