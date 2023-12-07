<?php

use App\Enums\WorkType;
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
        Schema::table('works', function (Blueprint $table) {
            $table->enum('type', WorkType::values())->default(WorkType::DELIVERY->value);
            $table->renameColumn('distance', 'duration');
            $table->renameColumn('percent', 'quota');
            $table->dropColumn('status');
            $table->dropColumn('description');
        });
    }
};
