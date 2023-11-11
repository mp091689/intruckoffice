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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id');
            $table->foreignId('load_id');
            $table->integer('distance');
            $table->integer('percent');
            $table->text('description')->nullable();
            $table->enum('status', ['in_progress', 'completed', 'invoiced'])->default('completed');
            $table->timestamps();
        });
    }
};
