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
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // 2. Brands
        $brands = [
            ['id' => 1, 'nama_brand' => 'Eiger'],
            ['id' => 2, 'nama_brand' => 'Consina'],
            ['id' => 3, 'nama_brand' => 'Rei'],
            ['id' => 4, 'nama_brand' => 'Deuter'],
            ['id' => 5, 'nama_brand' => 'Avtech'],
            ['id' => 6, 'nama_brand' => 'The North Face'],
            ['id' => 7, 'nama_brand' => 'Naturehike'],
            ['id' => 8, 'nama_brand' => 'Coleman'],
        ];


        foreach ($brands as $brand) {
            Brand::create($brand);
        }


        // 3. Colors
        $colors = [
            ['id' => 1, 'nama_warna' => 'Hitam'],
            ['id' => 2, 'nama_warna' => 'Abu-abu'],
            ['id' => 3, 'nama_warna' => 'Biru'],
            ['id' => 4, 'nama_warna' => 'Merah'],
            ['id' => 5, 'nama_warna' => 'Hijau'],
            ['id' => 6, 'nama_warna' => 'Orange'],
            ['id' => 7, 'nama_warna' => 'Kuning'],
            ['id' => 8, 'nama_warna' => 'Coklat'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }

        // 1. Categories + Sizes (list-based to preserve semua size)
        $categories = [
            ['id' => 1, 'nama_category' => 'Tenda', 'sizes' => ['2 Orang', '4 Orang', '6 Orang']],
            ['id' => 2, 'nama_category' => 'Sepatu', 'sizes' => ['38', '39', '40', '41', '42', '43']],
            ['id' => 3, 'nama_category' => 'Matras', 'sizes' => ['Single', 'Double']],
            ['id' => 4, 'nama_category' => 'Tas', 'sizes' => ['30L', '40L', '50L', '60L']],
            ['id' => 5, 'nama_category' => 'Pakaian', 'sizes' => ['S', 'M', 'L', 'XL', 'XXL']],
            ['id' => 6, 'nama_category' => 'Topi', 'sizes' => ['All Size']],
            ['id' => 7, 'nama_category' => 'Kompor', 'sizes' => ['Single Burner', 'Double Burner']],
            ['id' => 8, 'nama_category' => 'Furniture', 'sizes' => ['Standard']],
        ];

        $categoryIdMap = [];
        $sizeLookup = [];

        foreach ($categories as $category) {
            $categoryModel = Category::create([
                'id' => $category['id'],
                'nama_category' => $category['nama_category'],
            ]);

            $categoryIdMap[$category['id']] = $categoryModel->id;

            foreach ($category['sizes'] as $sizeLabel) {
                $sizeModel = Size::create([
                    'label_size' => $sizeLabel,
                    'id_category' => $categoryModel->id,
                ]);

                $sizeLookup[$categoryModel->id][$sizeLabel] = $sizeModel->id;
            }
        }

        // 5. Products + Variants + Variant Specs (runut)
        $products = [
            // Tenda
            ['id' => 1, 'nama_product' => 'Tenda Dome Waterproof', 'id_category' => 1, 'id_brand' => 1, 'deskripsi' => 'Tenda dome anti air dengan material berkualitas tinggi, cocok untuk camping keluarga', 'variants' => [
                ['id' => 1, 'id_color' => 5, 'sku_prefix' => 'TND-DOM-GRN', 'specs' => [
                    ['size_label' => '2 Orang', 'harga' => 850000, 'stok' => 15],
                    ['size_label' => '4 Orang', 'harga' => 1200000, 'stok' => 12],
                ]],
                ['id' => 2, 'id_color' => 6, 'sku_prefix' => 'TND-DOM-ORG', 'specs' => [
                    ['size_label' => '2 Orang', 'harga' => 850000, 'stok' => 10],
                    ['size_label' => '4 Orang', 'harga' => 1200000, 'stok' => 8],
                ]],
            ]],
            ['id' => 2, 'nama_product' => 'Tenda Ultralight Backpacking', 'id_category' => 1, 'id_brand' => 7, 'deskripsi' => 'Tenda ringan untuk backpacker dengan berat hanya 1.5kg', 'variants' => [
                ['id' => 3, 'id_color' => 2, 'sku_prefix' => 'TND-ULT-GRY', 'specs' => [
                    ['size_label' => '2 Orang', 'harga' => 650000, 'stok' => 20],
                ]],
            ]],
            ['id' => 3, 'nama_product' => 'Tenda Tunnel 4 Season', 'id_category' => 1, 'id_brand' => 8, 'deskripsi' => 'Tenda tunnel untuk segala musim dengan ventilasi optimal', 'variants' => [
                ['id' => 4, 'id_color' => 3, 'sku_prefix' => 'TND-TUN-BLU', 'specs' => [
                    ['size_label' => '4 Orang', 'harga' => 2500000, 'stok' => 5],
                    ['size_label' => '6 Orang', 'harga' => 3200000, 'stok' => 3],
                ]],
            ]],

            // Sepatu
            ['id' => 4, 'nama_product' => 'Sepatu Hiking Mid Cut', 'id_category' => 2, 'id_brand' => 1, 'deskripsi' => 'Sepatu hiking dengan ankle support dan grip kuat', 'variants' => [
                ['id' => 5, 'id_color' => 1, 'sku_prefix' => 'SPT-HIK-BLK', 'specs' => [
                    ['size_label' => '39', 'harga' => 950000, 'stok' => 8],
                    ['size_label' => '40', 'harga' => 950000, 'stok' => 12],
                    ['size_label' => '41', 'harga' => 950000, 'stok' => 15],
                    ['size_label' => '42', 'harga' => 950000, 'stok' => 12],
                    ['size_label' => '43', 'harga' => 950000, 'stok' => 8],
                ]],
                ['id' => 6, 'id_color' => 8, 'sku_prefix' => 'SPT-HIK-BRW', 'specs' => [
                    ['size_label' => '39', 'harga' => 950000, 'stok' => 6],
                    ['size_label' => '40', 'harga' => 950000, 'stok' => 10],
                    ['size_label' => '41', 'harga' => 950000, 'stok' => 12],
                    ['size_label' => '42', 'harga' => 950000, 'stok' => 10],
                    ['size_label' => '43', 'harga' => 950000, 'stok' => 6],
                ]],
            ]],
            ['id' => 5, 'nama_product' => 'Sepatu Trail Running', 'id_category' => 2, 'id_brand' => 6, 'deskripsi' => 'Sepatu ringan untuk trail running dengan traksi maksimal', 'variants' => [
                ['id' => 7, 'id_color' => 3, 'sku_prefix' => 'SPT-TRL-BLU', 'specs' => [
                    ['size_label' => '39', 'harga' => 1850000, 'stok' => 5],
                    ['size_label' => '40', 'harga' => 1850000, 'stok' => 8],
                    ['size_label' => '41', 'harga' => 1850000, 'stok' => 10],
                    ['size_label' => '42', 'harga' => 1850000, 'stok' => 8],
                    ['size_label' => '43', 'harga' => 1850000, 'stok' => 5],
                ]],
            ]],
            ['id' => 6, 'nama_product' => 'Sepatu Approach', 'id_category' => 2, 'id_brand' => 3, 'deskripsi' => 'Sepatu approach untuk trekking dan climbing', 'variants' => [
                ['id' => 8, 'id_color' => 2, 'sku_prefix' => 'SPT-APP-GRY', 'specs' => [
                    ['size_label' => '40', 'harga' => 1250000, 'stok' => 7],
                    ['size_label' => '41', 'harga' => 1250000, 'stok' => 10],
                    ['size_label' => '42', 'harga' => 1250000, 'stok' => 8],
                ]],
            ]],

            // Matras
            ['id' => 7, 'nama_product' => 'Matras Busa Lipat', 'id_category' => 3, 'id_brand' => 2, 'deskripsi' => 'Matras busa EVA tebal 5cm, mudah dilipat', 'variants' => [
                ['id' => 9, 'id_color' => 3, 'sku_prefix' => 'MAT-BSA-BLU', 'specs' => [
                    ['size_label' => 'Single', 'harga' => 125000, 'stok' => 30],
                    ['size_label' => 'Double', 'harga' => 185000, 'stok' => 20],
                ]],
                ['id' => 10, 'id_color' => 5, 'sku_prefix' => 'MAT-BSA-GRN', 'specs' => [
                    ['size_label' => 'Single', 'harga' => 125000, 'stok' => 25],
                    ['size_label' => 'Double', 'harga' => 185000, 'stok' => 18],
                ]],
            ]],
            ['id' => 8, 'nama_product' => 'Matras Self Inflating', 'id_category' => 3, 'id_brand' => 4, 'deskripsi' => 'Matras otomatis mengembang dengan valve pintar', 'variants' => [
                ['id' => 11, 'id_color' => 2, 'sku_prefix' => 'MAT-SLF-GRY', 'specs' => [
                    ['size_label' => 'Single', 'harga' => 450000, 'stok' => 15],
                    ['size_label' => 'Double', 'harga' => 650000, 'stok' => 10],
                ]],
            ]],
            ['id' => 9, 'nama_product' => 'Matras Air Bed', 'id_category' => 3, 'id_brand' => 8, 'deskripsi' => 'Kasur angin dengan pompa elektrik built-in', 'variants' => [
                ['id' => 12, 'id_color' => 3, 'sku_prefix' => 'MAT-AIR-BLU', 'specs' => [
                    ['size_label' => 'Double', 'harga' => 850000, 'stok' => 8],
                ]],
            ]],

            // Tas
            ['id' => 10, 'nama_product' => 'Carrier 50L Mountain', 'id_category' => 4, 'id_brand' => 1, 'deskripsi' => 'Carrier dengan rain cover dan sistem suspensi ergonomis', 'variants' => [
                ['id' => 13, 'id_color' => 1, 'sku_prefix' => 'TAS-CAR-BLK', 'specs' => [
                    ['size_label' => '50L', 'harga' => 1250000, 'stok' => 12],
                ]],
                ['id' => 14, 'id_color' => 4, 'sku_prefix' => 'TAS-CAR-RED', 'specs' => [
                    ['size_label' => '50L', 'harga' => 1250000, 'stok' => 10],
                ]],
            ]],
            ['id' => 11, 'nama_product' => 'Daypack Hiking', 'id_category' => 4, 'id_brand' => 2, 'deskripsi' => 'Tas daypack dengan kompartemen hydration', 'variants' => [
                ['id' => 15, 'id_color' => 3, 'sku_prefix' => 'TAS-DAY-BLU', 'specs' => [
                    ['size_label' => '30L', 'harga' => 450000, 'stok' => 20],
                    ['size_label' => '40L', 'harga' => 550000, 'stok' => 15],
                ]],
            ]],
            ['id' => 12, 'nama_product' => 'Tas Gunung 60L Pro', 'id_category' => 4, 'id_brand' => 4, 'deskripsi' => 'Tas gunung profesional dengan frame internal', 'variants' => [
                ['id' => 16, 'id_color' => 2, 'sku_prefix' => 'TAS-GUN-GRY', 'specs' => [
                    ['size_label' => '60L', 'harga' => 1850000, 'stok' => 8],
                ]],
            ]],

            // Pakaian
            ['id' => 13, 'nama_product' => 'Jaket Windbreaker', 'id_category' => 5, 'id_brand' => 1, 'deskripsi' => 'Jaket anti angin dengan bahan breathable', 'variants' => [
                ['id' => 17, 'id_color' => 1, 'sku_prefix' => 'PKN-JKT-BLK', 'specs' => [
                    ['size_label' => 'S', 'harga' => 450000, 'stok' => 15],
                    ['size_label' => 'M', 'harga' => 450000, 'stok' => 20],
                    ['size_label' => 'L', 'harga' => 450000, 'stok' => 25],
                    ['size_label' => 'XL', 'harga' => 450000, 'stok' => 20],
                    ['size_label' => 'XXL', 'harga' => 450000, 'stok' => 12],
                ]],
                ['id' => 18, 'id_color' => 3, 'sku_prefix' => 'PKN-JKT-BLU', 'specs' => [
                    ['size_label' => 'S', 'harga' => 450000, 'stok' => 12],
                    ['size_label' => 'M', 'harga' => 450000, 'stok' => 18],
                    ['size_label' => 'L', 'harga' => 450000, 'stok' => 22],
                    ['size_label' => 'XL', 'harga' => 450000, 'stok' => 18],
                ]],
            ]],
            ['id' => 14, 'nama_product' => 'Quick Dry Shirt', 'id_category' => 5, 'id_brand' => 6, 'deskripsi' => 'Kaos quick dry dengan UV protection', 'variants' => [
                ['id' => 19, 'id_color' => 2, 'sku_prefix' => 'PKN-SHT-GRY', 'specs' => [
                    ['size_label' => 'M', 'harga' => 250000, 'stok' => 25],
                    ['size_label' => 'L', 'harga' => 250000, 'stok' => 30],
                    ['size_label' => 'XL', 'harga' => 250000, 'stok' => 25],
                ]],
                ['id' => 20, 'id_color' => 5, 'sku_prefix' => 'PKN-SHT-GRN', 'specs' => [
                    ['size_label' => 'M', 'harga' => 250000, 'stok' => 20],
                    ['size_label' => 'L', 'harga' => 250000, 'stok' => 28],
                    ['size_label' => 'XL', 'harga' => 250000, 'stok' => 22],
                ]],
            ]],
            ['id' => 15, 'nama_product' => 'Celana Hiking Convertible', 'id_category' => 5, 'id_brand' => 3, 'deskripsi' => 'Celana panjang yang bisa dijadikan pendek dengan zipper', 'variants' => [
                ['id' => 21, 'id_color' => 8, 'sku_prefix' => 'PKN-CLN-BRW', 'specs' => [
                    ['size_label' => 'M', 'harga' => 550000, 'stok' => 12],
                    ['size_label' => 'L', 'harga' => 550000, 'stok' => 15],
                    ['size_label' => 'XL', 'harga' => 550000, 'stok' => 12],
                ]],
            ]],

            // Topi
            ['id' => 16, 'nama_product' => 'Topi Rimba Boonie', 'id_category' => 6, 'id_brand' => 1, 'deskripsi' => 'Topi rimba dengan tali pengikat dan ventilasi', 'variants' => [
                ['id' => 22, 'id_color' => 5, 'sku_prefix' => 'TOP-RMB-GRN', 'specs' => [
                    ['size_label' => 'All Size', 'harga' => 150000, 'stok' => 30],
                ]],
                ['id' => 23, 'id_color' => 8, 'sku_prefix' => 'TOP-RMB-BRW', 'specs' => [
                    ['size_label' => 'All Size', 'harga' => 150000, 'stok' => 25],
                ]],
            ]],
            ['id' => 17, 'nama_product' => 'Cap Adventure', 'id_category' => 6, 'id_brand' => 5, 'deskripsi' => 'Topi baseball cap dengan material quick dry', 'variants' => [
                ['id' => 24, 'id_color' => 1, 'sku_prefix' => 'TOP-CAP-BLK', 'specs' => [
                    ['size_label' => 'All Size', 'harga' => 125000, 'stok' => 35],
                ]],
            ]],
            ['id' => 18, 'nama_product' => 'Topi Gunung Safari', 'id_category' => 6, 'id_brand' => 2, 'deskripsi' => 'Topi safari dengan neck flap protection', 'variants' => [
                ['id' => 25, 'id_color' => 2, 'sku_prefix' => 'TOP-SAF-GRY', 'specs' => [
                    ['size_label' => 'All Size', 'harga' => 175000, 'stok' => 20],
                ]],
            ]],

            // Kompor
            ['id' => 19, 'nama_product' => 'Kompor Gas Portable', 'id_category' => 7, 'id_brand' => 2, 'deskripsi' => 'Kompor portable dengan piezo ignition', 'variants' => [
                ['id' => 26, 'id_color' => 1, 'sku_prefix' => 'KMP-GAS-BLK', 'specs' => [
                    ['size_label' => 'Single Burner', 'harga' => 350000, 'stok' => 15],
                    ['size_label' => 'Double Burner', 'harga' => 550000, 'stok' => 10],
                ]],
            ]],
            ['id' => 20, 'nama_product' => 'Kompor Camping Multi Fuel', 'id_category' => 7, 'id_brand' => 8, 'deskripsi' => 'Kompor multi bahan bakar untuk camping ekstrem', 'variants' => [
                ['id' => 27, 'id_color' => 4, 'sku_prefix' => 'KMP-MLT-RED', 'specs' => [
                    ['size_label' => 'Single Burner', 'harga' => 1250000, 'stok' => 8],
                ]],
            ]],
            ['id' => 21, 'nama_product' => 'Kompor Ultralight Titanium', 'id_category' => 7, 'id_brand' => 7, 'deskripsi' => 'Kompor ringan dari titanium untuk backpacker', 'variants' => [
                ['id' => 28, 'id_color' => 2, 'sku_prefix' => 'KMP-TIT-GRY', 'specs' => [
                    ['size_label' => 'Single Burner', 'harga' => 850000, 'stok' => 12],
                ]],
            ]],

            // Furniture
            ['id' => 22, 'nama_product' => 'Kursi Lipat Camping', 'id_category' => 8, 'id_brand' => 8, 'deskripsi' => 'Kursi lipat dengan cup holder dan storage', 'variants' => [
                ['id' => 29, 'id_color' => 3, 'sku_prefix' => 'FRN-KRS-BLU', 'specs' => [
                    ['size_label' => 'Standard', 'harga' => 285000, 'stok' => 20],
                ]],
                ['id' => 30, 'id_color' => 4, 'sku_prefix' => 'FRN-KRS-RED', 'specs' => [
                    ['size_label' => 'Standard', 'harga' => 285000, 'stok' => 18],
                ]],
            ]],
            ['id' => 23, 'nama_product' => 'Meja Lipat Portable', 'id_category' => 8, 'id_brand' => 2, 'deskripsi' => 'Meja lipat aluminium dengan ketinggian adjustable', 'variants' => [
                ['id' => 31, 'id_color' => 2, 'sku_prefix' => 'FRN-MJA-GRY', 'specs' => [
                    ['size_label' => 'Standard', 'harga' => 425000, 'stok' => 15],
                ]],
            ]],
            ['id' => 24, 'nama_product' => 'Hammock Outdoor', 'id_category' => 8, 'id_brand' => 1, 'deskripsi' => 'Hammock parachute material dengan mosquito net', 'variants' => [
                ['id' => 32, 'id_color' => 5, 'sku_prefix' => 'FRN-HMK-GRN', 'specs' => [
                    ['size_label' => 'Standard', 'harga' => 375000, 'stok' => 12],
                ]],
            ]],
        ];

        foreach ($products as $product) {
            $productModel = Product::create([
                'id' => $product['id'],
                'nama_product' => $product['nama_product'],
                'id_category' => $product['id_category'],
                'id_brand' => $product['id_brand'],
                'deskripsi' => $product['deskripsi'],
            ]);

            foreach ($product['variants'] ?? [] as $variant) {
                $variantModel = ProductVariant::create([
                    'id' => $variant['id'],
                    'id_product' => $productModel->id,
                    'id_color' => $variant['id_color'],
                ]);

                foreach ($variant['specs'] ?? [] as $spec) {
                    $sizeId = Size::where('id_category', $productModel->id_category)
                        ->where('label_size', $spec['size_label'])
                        ->value('id');

                    // Generate SKU: PREFIX-SIZE (contoh: SPT-TRL-BLU-40)
                    $sizeForSku = str_replace(' ', '', $spec['size_label']);
                    $sku = $variant['sku_prefix'] . '-' . $sizeForSku;

                    ProductVariantSpec::create([
                        'id_variant' => $variantModel->id,
                        'id_size' => $sizeId,
                        'sku' => $sku,
                        'harga' => $spec['harga'],
                        'stok' => $spec['stok'],
                    ]);
                }
            }
        }

        // 8. Users
        $users = [
            [
                'id' => 1,
                'nama_lengkap' => 'Admin Outventure',
                'email' => 'admin@outventure.com',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Outdoor Adventure No. 1, Jakarta',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'no_telepon' => '081234567891',
                'alamat' => 'Jl. Gunung Merapi No. 10, Bandung',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'id' => 3,
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti@email.com',
                'no_telepon' => '081234567892',
                'alamat' => 'Jl. Pantai Indah No. 25, Yogyakarta',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'id' => 4,
                'nama_lengkap' => 'Ahmad Ridwan',
                'email' => 'ahmad@email.com',
                'no_telepon' => '081234567893',
                'alamat' => 'Jl. Rimba Raya No. 15, Bogor',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'id' => 5,
                'nama_lengkap' => 'Dewi Lestari',
                'email' => 'dewi@email.com',
                'no_telepon' => '081234567894',
                'alamat' => 'Jl. Bukit Tinggi No. 8, Surabaya',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // 9. Orders
        $orders = [
            [
                'id' => 1,
                'id_user' => 2,
                'tgl_order' => '2025-12-01 10:30:00',
                'total_harga' => 2100000,
                'status_pembayaran' => 1, // paid
            ],
            [
                'id' => 2,
                'id_user' => 3,
                'tgl_order' => '2025-12-05 14:20:00',
                'total_harga' => 1500000,
                'status_pembayaran' => 1, // paid
            ],
            [
                'id' => 3,
                'id_user' => 4,
                'tgl_order' => '2025-12-08 09:15:00',
                'total_harga' => 3200000,
                'status_pembayaran' => 0, // pending
            ],
            [
                'id' => 4,
                'id_user' => 5,
                'tgl_order' => '2025-12-12 16:45:00',
                'total_harga' => 875000,
                'status_pembayaran' => 1, // paid
            ],
            [
                'id' => 5,
                'id_user' => 2,
                'tgl_order' => '2025-12-15 11:00:00',
                'total_harga' => 1750000,
                'status_pembayaran' => 0, // pending
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        // 10. Order Items (resolve spec via SKU langsung)
        $orderItems = [
            // Order 1 - Budi beli tenda dan matras
            ['id_order' => 1, 'sku' => 'TND-DOM-GRN-4Orang', 'tgl_order' => '2025-12-01 10:30:00', 'quantity' => 1, 'harga' => 1200000],
            ['id_order' => 1, 'sku' => 'MAT-BSA-BLU-Double', 'tgl_order' => '2025-12-01 10:30:00', 'quantity' => 2, 'harga' => 185000],

            // Order 2 - Siti beli sepatu hiking
            ['id_order' => 2, 'sku' => 'SPT-HIK-BLK-39', 'tgl_order' => '2025-12-05 14:20:00', 'quantity' => 1, 'harga' => 950000],
            ['id_order' => 2, 'sku' => 'PKN-SHT-GRY-M', 'tgl_order' => '2025-12-05 14:20:00', 'quantity' => 2, 'harga' => 250000],

            // Order 3 - Ahmad beli tas carrier dan jaket
            ['id_order' => 3, 'sku' => 'TAS-GUN-GRY-60L', 'tgl_order' => '2025-12-08 09:15:00', 'quantity' => 1, 'harga' => 1850000],
            ['id_order' => 3, 'sku' => 'PKN-JKT-BLK-S', 'tgl_order' => '2025-12-08 09:15:00', 'quantity' => 3, 'harga' => 450000],

            // Order 4 - Dewi beli kompor dan furniture
            ['id_order' => 4, 'sku' => 'KMP-GAS-BLK-SingleBurner', 'tgl_order' => '2025-12-12 16:45:00', 'quantity' => 1, 'harga' => 350000],
            ['id_order' => 4, 'sku' => 'FRN-KRS-BLU-Standard', 'tgl_order' => '2025-12-12 16:45:00', 'quantity' => 2, 'harga' => 285000],

            // Order 5 - Budi beli lagi sepatu trail running
            ['id_order' => 5, 'sku' => 'SPT-TRL-BLU-39', 'tgl_order' => '2025-12-15 11:00:00', 'quantity' => 1, 'harga' => 1850000],
        ];

        foreach ($orderItems as $item) {
            // Cari spec berdasarkan SKU langsung
            $spec = ProductVariantSpec::where('sku', $item['sku'])->firstOrFail();

            OrderItem::create([
                'id_order' => $item['id_order'],
                'id_variant_spec' => $spec->id,
                'tgl_order' => $item['tgl_order'],
                'quantity' => $item['quantity'],
                'harga' => $item['harga'],
            ]);
        }

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Categories: ' . Category::count());
        $this->command->info('   - Brands: ' . Brand::count());
        $this->command->info('   - Colors: ' . Color::count());
        $this->command->info('   - Sizes: ' . Size::count());
        $this->command->info('   - Products: ' . Product::count());
        $this->command->info('   - Product Variants: ' . ProductVariant::count());
        $this->command->info('   - Product Variant Specs: ' . ProductVariantSpec::count());
        $this->command->info('   - Users: ' . User::count());
        $this->command->info('   - Orders: ' . Order::count());
        $this->command->info('   - Order Items: ' . OrderItem::count());
    }
}
