<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loads', function (Blueprint $table) {
            $table->string('pickup_zip', 7)->default('');
            $table->string('pickup_country', 10)->default('');
            $table->string('pickup_state', 50)->default('');
            $table->string('pickup_city')->default('');
            $table->string('pickup_lat')->default('');
            $table->string('pickup_lng')->default('');

            $table->string('dropoff_zip', 7)->default('');
            $table->string('dropoff_country', 10)->default('');
            $table->string('dropoff_state', 50)->default('');
            $table->string('dropoff_city')->default('');
            $table->string('dropoff_lat')->default('');
            $table->string('dropoff_lng')->default('');

            $table->string('pickup_address')->nullable()->change();
            $table->string('dropoff_address')->nullable()->change();
        });
    }
};
