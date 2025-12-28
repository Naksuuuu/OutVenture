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
        Schema::create('product_variant_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_variant')->constrained('product_variants')->onDelete('cascade');
            $table->foreignId('id_size_value')->constrained('size_values')->onDelete('cascade');
            $table->string('sku')->unique();
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_specs');
    }
};
