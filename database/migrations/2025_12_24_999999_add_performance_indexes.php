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
    // Add indexes to products table
    Schema::table('products', function (Blueprint $table) {
      $table->index('id_category', 'idx_products_category');
      $table->index('id_brand', 'idx_products_brand');
    });

    // Add indexes to product_variants table
    Schema::table('product_variants', function (Blueprint $table) {
      $table->index('id_product', 'idx_variants_product');
      $table->index('id_color', 'idx_variants_color');
    });

    // Add indexes to product_variant_specs table
    Schema::table('product_variant_specs', function (Blueprint $table) {
      $table->index('id_variant', 'idx_specs_variant');
      $table->index('id_size_value', 'idx_specs_size');
      $table->index('harga', 'idx_specs_price');
      $table->index('stok', 'idx_specs_stock');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('products', function (Blueprint $table) {
      $table->dropIndex('idx_products_category');
      $table->dropIndex('idx_products_brand');
    });

    Schema::table('product_variants', function (Blueprint $table) {
      $table->dropIndex('idx_variants_product');
      $table->dropIndex('idx_variants_color');
    });

    Schema::table('product_variant_specs', function (Blueprint $table) {
      $table->dropIndex('idx_specs_variant');
      $table->dropIndex('idx_specs_size');
      $table->dropIndex('idx_specs_price');
      $table->dropIndex('idx_specs_stock');
    });
  }
};
