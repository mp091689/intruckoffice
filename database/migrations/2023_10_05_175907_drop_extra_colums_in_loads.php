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
            $table->dropColumn('driver_id');
            $table->dropColumn('driver2_id');
            $table->dropColumn('percentage');
            $table->dropColumn('percentage2');
        });
    }
};
