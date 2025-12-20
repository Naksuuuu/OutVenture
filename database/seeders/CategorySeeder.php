<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Carrier' => [
                '20 L',
                '30 L',
                '40 L',
                '50 L',
                '60 L',
                '70 L',
            ],
            'Tenda' => [
                '2 Pax',
                '4 Pax',
                '6 Pax',
                '8 Pax',
            ],
            'Sepatu' => [
                '38',
                '39',
                '40',
                '41',
                '42',
                '43',
                '44',
                '45',
            ],
            'Pakaian' => [
                'S',
                'M',
                'L',
                'XL',
                'XXL',
            ],
            'Sleeping Bag' => [
                'Regular',
                'Long',
            ],
        ];

        foreach ($categories as $catName => $sizes) {
            $category = Category::firstOrCreate(['nama_category' => $catName]);
            foreach ($sizes as $label) {
                Size::firstOrCreate([
                    'label_size' => $label,
                    'id_category' => $category->id
                ]);
            }
        }
    }
}
