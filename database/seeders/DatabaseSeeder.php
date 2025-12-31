<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use App\Models\SizeGroup;
use App\Models\SizeValue;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'nama_lengkap' => 'Admin Outventure',
                'email' => 'outventureindonesia@gmail.com',
                'email_verified_at' => now(),
                'alamat' => 'Jl. Outdoor Adventure No. 1, Jakarta',
                'password' => bcrypt('admin123'),
                'role' => 'superadmin',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }

    // public function run(): void
    // {
    //     User::create([
    //         'nama_lengkap' => 'Admin Outventure',
    //         'email' => 'outventureindonesia@gmail.com',
    //         'email_verified_at' => now(),
    //         'alamat' => 'Jl. Outdoor Adventure No. 1, Jakarta',
    //         'password' => bcrypt('admin123'),
    //         'role' => 'superadmin',
    //     ]);

    //     $dummyUsers = ['Budi Santoso', 'Siti Aminah', 'Rudi Hermawan', 'Dewi Lestari', 'Andi Pratama'];
    //     foreach ($dummyUsers as $index => $name) {
    //         User::create([
    //             'nama_lengkap' => $name,
    //             'email' => 'user' . ($index + 1) . '@example.com',
    //             'email_verified_at' => now(),
    //             'alamat' => 'Jl. Contoh No. ' . ($index + 1) . ', Kota Bandung',
    //             'password' => bcrypt('password'),
    //             'role' => 'user',
    //         ]);
    //     }

    //     $brandNames = ['Eiger', 'Consina', 'Arei', 'The North Face', 'Patagonia', 'Osprey', 'Deuter', 'Mammut', 'Quechua', 'Columbia'];
    //     $brands = collect();
    //     foreach ($brandNames as $name) {
    //         $brands->push(Brand::create([
    //             'nama_brand' => $name,
    //             'slug' => Str::slug($name),
    //             'is_trusted' => rand(0, 1),
    //         ]));
    //     }

    //     $colorData = [
    //         ['Hitam', '#000000'],
    //         ['Putih', '#FFFFFF'],
    //         ['Merah', '#FF0000'],
    //         ['Biru', '#0000FF'],
    //         ['Hijau', '#008000'],
    //         ['Abu-abu', '#808080'],
    //         ['Navy', '#000080'],
    //         ['Kuning', '#FFFF00'],
    //         ['Orange', '#FFA500'],
    //         ['Coklat', '#A52A2A'],
    //     ];
    //     $colors = collect();
    //     foreach ($colorData as $data) {
    //         $colors->push(Color::create([
    //             'nama_warna' => $data[0],
    //             'hex_code' => $data[1],
    //             'slug' => Str::slug($data[0]),
    //         ]));
    //     }

    //     $sizeData = [
    //         'Atasan/Bawahan' => ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL'],
    //         'Sepatu/Sandal' => ['36', '37', '38', '39', '40', '41', '42', '43', '44', '45'],
    //         'Aksesoris' => ['All Size'],
    //         'Tenda' => ['2P', '4P', '6P'],
    //         'Carrier' => ['30L', '45L', '60L', '75L'],
    //     ];

    //     $sizeGroups = [];
    //     foreach ($sizeData as $groupName => $sizes) {
    //         $group = SizeGroup::create(['nama_group' => $groupName]);
    //         $sizeGroups[$groupName] = [
    //             'group' => $group,
    //             'values' => collect()
    //         ];

    //         foreach ($sizes as $index => $sizeLabel) {
    //             $sizeValue = SizeValue::create([
    //                 'id_size_group' => $group->id,
    //                 'label_size' => $sizeLabel,
    //                 'sort_order' => $index + 1,
    //             ]);
    //             $sizeGroups[$groupName]['values']->push($sizeValue);
    //         }
    //     }

    //     $categoriesData = [
    //         'Jaket Gunung' => 'Atasan/Bawahan',
    //         'Kaos Outdoor' => 'Atasan/Bawahan',
    //         'Celana Cargo' => 'Atasan/Bawahan',
    //         'Sepatu Hiking' => 'Sepatu/Sandal',
    //         'Sandal Gunung' => 'Sepatu/Sandal',
    //         'Topi Rimba' => 'Aksesoris',
    //         'Tenda Dome' => 'Tenda',
    //         'Tas Carrier' => 'Carrier',
    //     ];

    //     $categories = collect();
    //     foreach ($categoriesData as $catName => $groupName) {
    //         $categories->push(Category::create([
    //             'nama_category' => $catName,
    //             'slug' => Str::slug($catName),
    //             'id_size_group' => $sizeGroups[$groupName]['group']->id,
    //         ]));
    //     }

    //     $productPrefixes = ['Ultimate', 'Pro', 'Light', 'Heavy Duty', 'Ultra', 'Extreme', 'Basic', 'Comfort'];

    //     foreach ($categories as $category) {
    //         $groupName = $categoriesData[$category->nama_category];
    //         $validSizes = $sizeGroups[$groupName]['values'];

    //         $productsCount = rand(3, 5);
    //         for ($i = 0; $i < $productsCount; $i++) {
    //             $brand = $brands->random();
    //             $prefix = $productPrefixes[array_rand($productPrefixes)];
    //             $name = $prefix . ' ' . $category->nama_category . ' ' . $brand->nama_brand . ' ' . rand(100, 999);

    //             $product = Product::create([
    //                 'id_category' => $category->id,
    //                 'id_brand' => $brand->id,
    //                 'nama_product' => $name,
    //                 'slug' => Str::slug($name),
    //                 'deskripsi' => 'Deskripsi lengkap untuk produk ' . $name . '. Cocok untuk kegiatan outdoor dan petualangan.',
    //             ]);

    //             $productColors = $colors->random(rand(2, 4));

    //             foreach ($productColors as $color) {
    //                 $variant = ProductVariant::create([
    //                     'id_product' => $product->id,
    //                     'id_color' => $color->id,
    //                 ]);

    //                 $maxPick = $validSizes->count();
    //                 $pickCount = rand(1, $maxPick);
    //                 $variantSizes = $validSizes->random($pickCount);

    //                 foreach ($variantSizes as $size) {
    //                     ProductVariantSpec::create([
    //                         'id_variant' => $variant->id,
    //                         'id_size_value' => $size->id,
    //                         'sku' => strtoupper(Str::slug($brand->nama_brand) . '-' . Str::random(5)),
    //                         'harga' => rand(5, 50) * 10000,
    //                         'stok' => rand(0, 50),
    //                     ]);
    //                 }
    //             }
    //         }
    //     }
    // }
}
