<?php

namespace Database\Seeders;

use App\Models\ProductVariantSpec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVariantSpec::factory()->count(50)->create();
    }
}
