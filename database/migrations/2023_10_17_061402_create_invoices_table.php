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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->text('generated_log');
            $table->string('total', 10);
            $table->text('custom_work')->nullable();
            $table->string('custom_total', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
