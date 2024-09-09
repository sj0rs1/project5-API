<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('orderedBy')->nullable();
            $table->json('productIds');
            $table->json('amounts');
            $table->integer('status'); // 1 ordered || 2 in delivery || 3 delivered (?)
            $table->string('firstname');
            $table->string('lastname');
            $table->string('postal');
            $table->string('number');
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
