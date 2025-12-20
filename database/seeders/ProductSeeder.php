<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create useful outdoor categories
        $category = ['Camping', 'Hiking', 'Backpacking', 'Outdoor Accessories', 'Clothing'];
        foreach ($category as $c) {
            Category::firstOrCreate(['nama_category' => $c]);
        }

        // create some outdoor brands (optional, Product stores brand as string)
        $brand = ['Eiger', 'Consina', 'Naturehike', 'The North Face', 'Columbia', 'Osprey', 'Quechua', 'Vango', 'Unbranded'];
        foreach ($brand as $b) {
            Brand::firstOrCreate(['nama_brand' => $b]);
        }

        // create specific realistic outdoor products
        $campingId = Category::where('nama_category', 'Camping')->first()->id;
        $hikingId = Category::where('nama_category', 'Hiking')->first()->id;

        $specific = [
            [
                'id_category' => $campingId,
                'nama_product' => 'Naturehike Cloud-Up Tenda 2P',
                'brand' => 'Naturehike',
                'deskripsi' => 'Tenda ringan, cepat dipasang, cocok untuk berkemah 2 orang. Bahan tahan air dan sirkulasi baik.'
            ],
            [
                'id_category' => $hikingId,
                'nama_product' => 'Eiger Trekker Sepatu Hiking Mid',
                'brand' => 'Eiger',
                'deskripsi' => 'Sepatu hiking dengan grip kuat dan ankle support untuk jalur berat.'
            ],
            [
                'id_category' => $hikingId,
                'nama_product' => 'Osprey Atmos Carrier 65L',
                'brand' => 'Osprey',
                'deskripsi' => 'Carrier punggung ergonomis dengan ventilasi dan banyak kompartemen untuk backpacking multi-hari.'
            ],
            [
                'id_category' => $campingId,
                'nama_product' => 'Quechua Sleeping Bag -5C',
                'brand' => 'Quechua',
                'deskripsi' => 'Sleeping bag nyaman untuk suhu dingin ringan, ringan dan mudah dimasukkan ke tas.'
            ],
            [
                'id_category' => $campingId,
                'nama_product' => 'Vango Kompor Camping Portable',
                'brand' => 'Vango',
                'deskripsi' => 'Kompor camping kecil, mudah dibawa, efisien untuk memasak di luar ruangan.'
            ],
        ];

        foreach ($specific as $p) {
            Product::firstOrCreate([
                'nama_product' => $p['nama_product']
            ], $p);
        }
    }
}
