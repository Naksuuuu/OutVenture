<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_product' => Product::factory(),
            'sku' => strtoupper(fake()->bothify('SKU-####-????')),
            'stok' => fake()->numberBetween(0, 100),
            'harga' => fake()->randomFloat(2, 10, 1000),
        ];
    }
}
