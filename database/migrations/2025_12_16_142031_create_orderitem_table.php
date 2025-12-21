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
        Schema::create('OrderItem', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('Order')->onDelete('cascade');
            $table->foreignId('id_variant_spec')->constrained('ProductVariantSpec')->onDelete('cascade');
            $table->dateTime('tgl_order');
            $table->decimal('harga', 10, 2);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderitem');
    }
};
