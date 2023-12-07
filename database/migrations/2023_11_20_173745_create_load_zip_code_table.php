<?php

use App\Enums\ZipCodeType;
use App\Models\Load;
use App\Services\ZipFinder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('load_zip_code', function (Blueprint $table) {
            $table->id();
            $table->foreignId('load_id');
            $table->foreignId('zip_code_id');
            $table->dateTime('datetime');
            $table->enum('type', ZipCodeType::values())->default(ZipCodeType::START);
        });
    }
};
