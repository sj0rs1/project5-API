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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->time('mo_start')->nullable()->default(null);
            $table->time('mo_end')->nullable()->default(null);
            $table->time('tu_start')->nullable()->default(null);
            $table->time('tu_end')->nullable()->default(null);
            $table->time('we_start')->nullable()->default(null);
            $table->time('we_end')->nullable()->default(null);
            $table->time('th_start')->nullable()->default(null);
            $table->time('th_end')->nullable()->default(null);
            $table->time('fr_start')->nullable()->default(null);
            $table->time('fr_end')->nullable()->default(null);
            $table->time('sa_start')->nullable()->default(null);
            $table->time('sa_end')->nullable()->default(null);
            $table->time('su_start')->nullable()->default(null);
            $table->time('su_end')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
