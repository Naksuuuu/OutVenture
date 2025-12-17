<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariantSpec>
 */
class ProductVariantSpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_variant' => ProductVariant::factory(),
            'id_attribute' => Attribute::factory(),
            'value' => $this->faker->word()
        ];
    }
}
