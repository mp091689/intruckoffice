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
            $table->renameColumn('price', 'estimated_price');
            $table->renameColumn('distance', 'estimated_distance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loads', function (Blueprint $table) {
            $table->renameColumn('estimated_price', 'price');
            $table->renameColumn('estimated_distance', 'distance');
        });
    }
};
