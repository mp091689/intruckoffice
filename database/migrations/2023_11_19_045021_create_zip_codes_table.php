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
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->id();
            $table->string('zip', 7)->unique();
            $table->string('country', 6);
            $table->string('state', 2);
            $table->string('city');
            $table->string('lng');
            $table->string('lat');
        });
    }
};
