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
            $table->string('pickup_address')->nullable();
            $table->timestamp('pickup_datetime')->nullable();
            $table->string('dropoff_address')->nullable();
            $table->timestamp('dropoff_datetime')->nullable();
            $table->string('price', 10)->nullable();
            $table->integer('distance')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
};
