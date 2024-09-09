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
        Schema::create('kuin_orders', function (Blueprint $table) {
            $table->id();
            $table->json('productIds');
            $table->json('amounts');
            $table->integer('status'); //1 = ordered - 2 = delivered (deletion = cancelled)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuin_orders');
    }
};
