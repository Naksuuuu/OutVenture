<?php

namespace Database\Seeders;


use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $attrMap = Size::pluck('id', 'label_size')->toArray();

        Product::all()->each(function ($product) use ($faker, $attrMap) {
            $variantCount = rand(1, 2);
            for ($i = 0; $i < $variantCount; $i++) {
                $variant = ProductVariant::create([
                    'id_product' => $product->id,
                    'sku' => strtoupper($faker->bothify('SKU-#####')),

                ]);

                $name = strtolower($product->nama_product);

                // determine attribute name and value based on product keywords
                if (str_contains($name, 'carrier') || str_contains($name, 'backpack')) {
                    $attrName = 'Carrier';
                    if (preg_match('/(\d+)\s?l/i', $product->nama_product, $m)) {
                        $value = $m[1] . ' L';
                    } else {
                        $value = $faker->randomElement(['40 L', '55 L', '65 L', '80 L']);
                    }
                } elseif (str_contains($name, 'tenda') || str_contains($name, 'tent')) {
                    $attrName = 'Tenda';
                    if (preg_match('/(\d+)p/i', $product->nama_product, $m)) {
                        $value = $m[1] . ' Pax';
                    } else {
                        $value = $faker->randomElement(['2 Pax', '4 Pax', '6 Pax']);
                    }
                } elseif (str_contains($name, 'sepatu') || str_contains($name, 'shoe') || str_contains($name, 'hiking')) {
                    $attrName = 'Sepatu';
                    $value = $faker->numberBetween(38, 46);
                } elseif (str_contains($name, 'sleep') || str_contains($name, 'sleeping')) {
                    $attrName = 'Sleeping Bag';
                    $value = $faker->randomElement(['-5 C', '0 C', '5 C']);
                } elseif (str_contains($name, 'headlamp') || str_contains($name, 'lamp')) {
                    $attrName = 'Headlamp';
                    $value = $faker->numberBetween(100, 1000) . ' lm';
                } elseif (str_contains($name, 'matras') || str_contains($name, 'mat')) {
                    $attrName = 'Matras';
                    $value = $faker->randomElement(['60x180 cm', '70x200 cm']);
                } else {

                    $attrName = $faker->randomElement(array_keys($attrMap));
                    $value = $faker->word();
                }


                // Skip if size/attribute doesn't exist
                if (! isset($attrMap[$attrName])) {
                    continue;
                }

                ProductVariantSpec::create([
                    'id_variant' => $variant->id,
                    'id_size' => $attrMap[$attrName],
                    'value' => (string) $value,
                ]);
            }
        });
    }
}
