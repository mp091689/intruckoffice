<?php

use App\Enums\LoadStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('loads')->update(['status' => LoadStatus::IN_PROGRESS]);

        Schema::table('loads', function (Blueprint $table) {
            $table->enum('status', LoadStatus::values())->default(LoadStatus::IN_PROGRESS->value)->change();
        });
    }
};
