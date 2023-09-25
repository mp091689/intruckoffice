<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_address')->nullable(false);
            $table->timestamp('pickup_datetime')->nullable(false);
            $table->string('dropoff_address')->nullable(false);
            $table->timestamp('dropoff_datetime')->nullable(false);
            $table->string('price', 10)->nullable(false);
            $table->integer('distance')->nullable(false);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};
