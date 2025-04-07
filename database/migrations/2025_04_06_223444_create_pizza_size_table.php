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
        Schema::create('pizza_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->enum('size', ['pequeña', 'mediana', 'grande']);
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_size');
    }
};
