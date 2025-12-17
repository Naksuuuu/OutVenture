<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_order' => Order::factory(),
            'id_variant' => ProductVariant::factory(),
            'quantity' => fake()->numberBetween(1, 5),
            'harga' => fake()->randomFloat(2, 5, 500),
            'tgl_order' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
