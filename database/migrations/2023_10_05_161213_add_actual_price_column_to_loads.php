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
        Schema::table('loads', function (Blueprint $table) {
            $table->string('actual_price')->after('estimated_price');
        });

        $rows = DB::table('loads')->get(['id', 'estimated_price']);
        foreach ($rows as $row) {
            DB::table('loads')
                ->where('id', $row->id)
                ->update(['actual_price' => $row->estimated_price]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loads', function (Blueprint $table) {
            $table->dropColumn('actual_price');
        });
    }
};
