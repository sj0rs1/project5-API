<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 10, 2);
            $table->string('image');
            $table->string('color');
            $table->integer('height_cm');
            $table->integer('width_cm');
            $table->integer('depth_cm');
            $table->integer('weight_gr');
            $table->integer('quantity');
            $table->integer('reorder_point');
            $table->integer('last_edited_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
