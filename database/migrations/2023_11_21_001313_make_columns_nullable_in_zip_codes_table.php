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
        Schema::table('zip_codes', function (Blueprint $table) {
            $table->string('country', 6)->nullable()->change();
            $table->string('state', 2)->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('lng')->nullable()->change();
            $table->string('lat')->nullable()->change();
        });
    }
};
