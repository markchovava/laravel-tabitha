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
        Schema::create('log_wakes', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->nullable();
            $table->integer('dailyReportId')->nullable();
            $table->integer('monthlyReportId')->nullable();
            $table->longText('details')->nullable();
            $table->string('patient')->nullable();
            $table->string('assistant')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_wakes');
    }
};
