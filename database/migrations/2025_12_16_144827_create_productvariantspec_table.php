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
        Schema::create('productvariantspec', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_variant')->constrained('productvariant')->onDelete('cascade');
            $table->foreignId('id_attribute')->constrained('attributes')->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productvariantspec');
    }
};
