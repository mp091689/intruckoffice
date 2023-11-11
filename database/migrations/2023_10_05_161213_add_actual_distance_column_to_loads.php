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
            $table->string('actual_distance')->after('estimated_distance');
        });

        $rows = DB::table('loads')->get(['id', 'estimated_distance']);
        foreach ($rows as $row) {
            DB::table('loads')
                ->where('id', $row->id)
                ->update(['actual_distance' => $row->estimated_distance]);
        }
    }
};
