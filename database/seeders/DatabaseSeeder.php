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
        // 1. Categories
        $categories = [
            ['id' => 1, 'nama_category' => 'Tenda'],
            ['id' => 2, 'nama_category' => 'Sepatu'],
            ['id' => 3, 'nama_category' => 'Matras'],
            ['id' => 4, 'nama_category' => 'Tas'],
            ['id' => 5, 'nama_category' => 'Pakaian'],
            ['id' => 6, 'nama_category' => 'Topi'],
            ['id' => 7, 'nama_category' => 'Kompor'],
            ['id' => 8, 'nama_category' => 'Furniture'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

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

        // 4. Sizes (per category)
        $sizes = [
            // Tenda - kapasitas
            ['id' => 1, 'label_size' => '2 Orang', 'id_category' => 1],
            ['id' => 2, 'label_size' => '4 Orang', 'id_category' => 1],
            ['id' => 3, 'label_size' => '6 Orang', 'id_category' => 1],
            // Sepatu - ukuran
            ['id' => 4, 'label_size' => '39', 'id_category' => 2],
            ['id' => 5, 'label_size' => '40', 'id_category' => 2],
            ['id' => 6, 'label_size' => '41', 'id_category' => 2],
            ['id' => 7, 'label_size' => '42', 'id_category' => 2],
            ['id' => 8, 'label_size' => '43', 'id_category' => 2],
            // Matras - ukuran
            ['id' => 9, 'label_size' => 'Single', 'id_category' => 3],
            ['id' => 10, 'label_size' => 'Double', 'id_category' => 3],
            // Tas - kapasitas liter
            ['id' => 11, 'label_size' => '30L', 'id_category' => 4],
            ['id' => 12, 'label_size' => '40L', 'id_category' => 4],
            ['id' => 13, 'label_size' => '50L', 'id_category' => 4],
            ['id' => 14, 'label_size' => '60L', 'id_category' => 4],
            // Pakaian - ukuran
            ['id' => 15, 'label_size' => 'S', 'id_category' => 5],
            ['id' => 16, 'label_size' => 'M', 'id_category' => 5],
            ['id' => 17, 'label_size' => 'L', 'id_category' => 5],
            ['id' => 18, 'label_size' => 'XL', 'id_category' => 5],
            ['id' => 19, 'label_size' => 'XXL', 'id_category' => 5],
            // Topi - ukuran
            ['id' => 20, 'label_size' => 'All Size', 'id_category' => 6],
            // Kompor - tipe
            ['id' => 21, 'label_size' => 'Single Burner', 'id_category' => 7],
            ['id' => 22, 'label_size' => 'Double Burner', 'id_category' => 7],
            // Furniture - ukuran
            ['id' => 23, 'label_size' => 'Standard', 'id_category' => 8],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }

        // 5. Products
        $products = [
            // Tenda
            ['id' => 1, 'nama_product' => 'Tenda Dome Waterproof', 'id_category' => 1, 'id_brand' => 1, 'deskripsi' => 'Tenda dome anti air dengan material berkualitas tinggi, cocok untuk camping keluarga'],
            ['id' => 2, 'nama_product' => 'Tenda Ultralight Backpacking', 'id_category' => 1, 'id_brand' => 7, 'deskripsi' => 'Tenda ringan untuk backpacker dengan berat hanya 1.5kg'],
            ['id' => 3, 'nama_product' => 'Tenda Tunnel 4 Season', 'id_category' => 1, 'id_brand' => 8, 'deskripsi' => 'Tenda tunnel untuk segala musim dengan ventilasi optimal'],

            // Sepatu
            ['id' => 4, 'nama_product' => 'Sepatu Hiking Mid Cut', 'id_category' => 2, 'id_brand' => 1, 'deskripsi' => 'Sepatu hiking dengan ankle support dan grip kuat'],
            ['id' => 5, 'nama_product' => 'Sepatu Trail Running', 'id_category' => 2, 'id_brand' => 6, 'deskripsi' => 'Sepatu ringan untuk trail running dengan traksi maksimal'],
            ['id' => 6, 'nama_product' => 'Sepatu Approach', 'id_category' => 2, 'id_brand' => 3, 'deskripsi' => 'Sepatu approach untuk trekking dan climbing'],

            // Matras
            ['id' => 7, 'nama_product' => 'Matras Busa Lipat', 'id_category' => 3, 'id_brand' => 2, 'deskripsi' => 'Matras busa EVA tebal 5cm, mudah dilipat'],
            ['id' => 8, 'nama_product' => 'Matras Self Inflating', 'id_category' => 3, 'id_brand' => 4, 'deskripsi' => 'Matras otomatis mengembang dengan valve pintar'],
            ['id' => 9, 'nama_product' => 'Matras Air Bed', 'id_category' => 3, 'id_brand' => 8, 'deskripsi' => 'Kasur angin dengan pompa elektrik built-in'],

            // Tas
            ['id' => 10, 'nama_product' => 'Carrier 50L Mountain', 'id_category' => 4, 'id_brand' => 1, 'deskripsi' => 'Carrier dengan rain cover dan sistem suspensi ergonomis'],
            ['id' => 11, 'nama_product' => 'Daypack Hiking', 'id_category' => 4, 'id_brand' => 2, 'deskripsi' => 'Tas daypack dengan kompartemen hydration'],
            ['id' => 12, 'nama_product' => 'Tas Gunung 60L Pro', 'id_category' => 4, 'id_brand' => 4, 'deskripsi' => 'Tas gunung profesional dengan frame internal'],

            // Pakaian
            ['id' => 13, 'nama_product' => 'Jaket Windbreaker', 'id_category' => 5, 'id_brand' => 1, 'deskripsi' => 'Jaket anti angin dengan bahan breathable'],
            ['id' => 14, 'nama_product' => 'Quick Dry Shirt', 'id_category' => 5, 'id_brand' => 6, 'deskripsi' => 'Kaos quick dry dengan UV protection'],
            ['id' => 15, 'nama_product' => 'Celana Hiking Convertible', 'id_category' => 5, 'id_brand' => 3, 'deskripsi' => 'Celana panjang yang bisa dijadikan pendek dengan zipper'],

            // Topi
            ['id' => 16, 'nama_product' => 'Topi Rimba Boonie', 'id_category' => 6, 'id_brand' => 1, 'deskripsi' => 'Topi rimba dengan tali pengikat dan ventilasi'],
            ['id' => 17, 'nama_product' => 'Cap Adventure', 'id_category' => 6, 'id_brand' => 5, 'deskripsi' => 'Topi baseball cap dengan material quick dry'],
            ['id' => 18, 'nama_product' => 'Topi Gunung Safari', 'id_category' => 6, 'id_brand' => 2, 'deskripsi' => 'Topi safari dengan neck flap protection'],

            // Kompor
            ['id' => 19, 'nama_product' => 'Kompor Gas Portable', 'id_category' => 7, 'id_brand' => 2, 'deskripsi' => 'Kompor portable dengan piezo ignition'],
            ['id' => 20, 'nama_product' => 'Kompor Camping Multi Fuel', 'id_category' => 7, 'id_brand' => 8, 'deskripsi' => 'Kompor multi bahan bakar untuk camping ekstrem'],
            ['id' => 21, 'nama_product' => 'Kompor Ultralight Titanium', 'id_category' => 7, 'id_brand' => 7, 'deskripsi' => 'Kompor ringan dari titanium untuk backpacker'],

            // Furniture
            ['id' => 22, 'nama_product' => 'Kursi Lipat Camping', 'id_category' => 8, 'id_brand' => 8, 'deskripsi' => 'Kursi lipat dengan cup holder dan storage'],
            ['id' => 23, 'nama_product' => 'Meja Lipat Portable', 'id_category' => 8, 'id_brand' => 2, 'deskripsi' => 'Meja lipat aluminium dengan ketinggian adjustable'],
            ['id' => 24, 'nama_product' => 'Hammock Outdoor', 'id_category' => 8, 'id_brand' => 1, 'deskripsi' => 'Hammock parachute material dengan mosquito net'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // 6. Product Variants (dengan SKU unik)
        $variants = [
            // Tenda variants (produk 1-3)
            ['id' => 1, 'id_product' => 1, 'id_color' => 5, 'sku' => 'TND-DOM-GRN-001'],
            ['id' => 2, 'id_product' => 1, 'id_color' => 6, 'sku' => 'TND-DOM-ORG-001'],
            ['id' => 3, 'id_product' => 2, 'id_color' => 2, 'sku' => 'TND-ULT-GRY-001'],
            ['id' => 4, 'id_product' => 3, 'id_color' => 3, 'sku' => 'TND-TUN-BLU-001'],

            // Sepatu variants (produk 4-6)
            ['id' => 5, 'id_product' => 4, 'id_color' => 1, 'sku' => 'SPT-HIK-BLK-001'],
            ['id' => 6, 'id_product' => 4, 'id_color' => 8, 'sku' => 'SPT-HIK-BRW-001'],
            ['id' => 7, 'id_product' => 5, 'id_color' => 3, 'sku' => 'SPT-TRL-BLU-001'],
            ['id' => 8, 'id_product' => 6, 'id_color' => 2, 'sku' => 'SPT-APP-GRY-001'],

            // Matras variants (produk 7-9)
            ['id' => 9, 'id_product' => 7, 'id_color' => 3, 'sku' => 'MAT-BSA-BLU-001'],
            ['id' => 10, 'id_product' => 7, 'id_color' => 5, 'sku' => 'MAT-BSA-GRN-001'],
            ['id' => 11, 'id_product' => 8, 'id_color' => 2, 'sku' => 'MAT-SLF-GRY-001'],
            ['id' => 12, 'id_product' => 9, 'id_color' => 3, 'sku' => 'MAT-AIR-BLU-001'],

            // Tas variants (produk 10-12)
            ['id' => 13, 'id_product' => 10, 'id_color' => 1, 'sku' => 'TAS-CAR-BLK-001'],
            ['id' => 14, 'id_product' => 10, 'id_color' => 4, 'sku' => 'TAS-CAR-RED-001'],
            ['id' => 15, 'id_product' => 11, 'id_color' => 3, 'sku' => 'TAS-DAY-BLU-001'],
            ['id' => 16, 'id_product' => 12, 'id_color' => 2, 'sku' => 'TAS-GUN-GRY-001'],

            // Pakaian variants (produk 13-15)
            ['id' => 17, 'id_product' => 13, 'id_color' => 1, 'sku' => 'PKN-JKT-BLK-001'],
            ['id' => 18, 'id_product' => 13, 'id_color' => 3, 'sku' => 'PKN-JKT-BLU-001'],
            ['id' => 19, 'id_product' => 14, 'id_color' => 2, 'sku' => 'PKN-SHT-GRY-001'],
            ['id' => 20, 'id_product' => 14, 'id_color' => 5, 'sku' => 'PKN-SHT-GRN-001'],
            ['id' => 21, 'id_product' => 15, 'id_color' => 8, 'sku' => 'PKN-CLN-BRW-001'],

            // Topi variants (produk 16-18)
            ['id' => 22, 'id_product' => 16, 'id_color' => 5, 'sku' => 'TOP-RMB-GRN-001'],
            ['id' => 23, 'id_product' => 16, 'id_color' => 8, 'sku' => 'TOP-RMB-BRW-001'],
            ['id' => 24, 'id_product' => 17, 'id_color' => 1, 'sku' => 'TOP-CAP-BLK-001'],
            ['id' => 25, 'id_product' => 18, 'id_color' => 2, 'sku' => 'TOP-SAF-GRY-001'],

            // Kompor variants (produk 19-21)
            ['id' => 26, 'id_product' => 19, 'id_color' => 1, 'sku' => 'KMP-GAS-BLK-001'],
            ['id' => 27, 'id_product' => 20, 'id_color' => 4, 'sku' => 'KMP-MLT-RED-001'],
            ['id' => 28, 'id_product' => 21, 'id_color' => 2, 'sku' => 'KMP-TIT-GRY-001'],

            // Furniture variants (produk 22-24)
            ['id' => 29, 'id_product' => 22, 'id_color' => 3, 'sku' => 'FRN-KRS-BLU-001'],
            ['id' => 30, 'id_product' => 22, 'id_color' => 4, 'sku' => 'FRN-KRS-RED-001'],
            ['id' => 31, 'id_product' => 23, 'id_color' => 2, 'sku' => 'FRN-MJA-GRY-001'],
            ['id' => 32, 'id_product' => 24, 'id_color' => 5, 'sku' => 'FRN-HMK-GRN-001'],
        ];

        foreach ($variants as $variant) {
            ProductVariant::create($variant);
        }

        // 7. Product Variant Specs (harga dan stok per size)
        $specs = [
            // Tenda specs
            ['id_variant' => 1, 'id_size' => 1, 'harga' => 850000, 'stok' => 15],
            ['id_variant' => 1, 'id_size' => 2, 'harga' => 1200000, 'stok' => 12],
            ['id_variant' => 2, 'id_size' => 1, 'harga' => 850000, 'stok' => 10],
            ['id_variant' => 2, 'id_size' => 2, 'harga' => 1200000, 'stok' => 8],
            ['id_variant' => 3, 'id_size' => 1, 'harga' => 650000, 'stok' => 20],
            ['id_variant' => 4, 'id_size' => 2, 'harga' => 2500000, 'stok' => 5],
            ['id_variant' => 4, 'id_size' => 3, 'harga' => 3200000, 'stok' => 3],

            // Sepatu specs
            ['id_variant' => 5, 'id_size' => 4, 'harga' => 950000, 'stok' => 8],
            ['id_variant' => 5, 'id_size' => 5, 'harga' => 950000, 'stok' => 12],
            ['id_variant' => 5, 'id_size' => 6, 'harga' => 950000, 'stok' => 15],
            ['id_variant' => 5, 'id_size' => 7, 'harga' => 950000, 'stok' => 12],
            ['id_variant' => 5, 'id_size' => 8, 'harga' => 950000, 'stok' => 8],
            ['id_variant' => 6, 'id_size' => 4, 'harga' => 950000, 'stok' => 6],
            ['id_variant' => 6, 'id_size' => 5, 'harga' => 950000, 'stok' => 10],
            ['id_variant' => 6, 'id_size' => 6, 'harga' => 950000, 'stok' => 12],
            ['id_variant' => 6, 'id_size' => 7, 'harga' => 950000, 'stok' => 10],
            ['id_variant' => 6, 'id_size' => 8, 'harga' => 950000, 'stok' => 6],
            ['id_variant' => 7, 'id_size' => 4, 'harga' => 1850000, 'stok' => 5],
            ['id_variant' => 7, 'id_size' => 5, 'harga' => 1850000, 'stok' => 8],
            ['id_variant' => 7, 'id_size' => 6, 'harga' => 1850000, 'stok' => 10],
            ['id_variant' => 7, 'id_size' => 7, 'harga' => 1850000, 'stok' => 8],
            ['id_variant' => 7, 'id_size' => 8, 'harga' => 1850000, 'stok' => 5],
            ['id_variant' => 8, 'id_size' => 5, 'harga' => 1250000, 'stok' => 7],
            ['id_variant' => 8, 'id_size' => 6, 'harga' => 1250000, 'stok' => 10],
            ['id_variant' => 8, 'id_size' => 7, 'harga' => 1250000, 'stok' => 8],

            // Matras specs
            ['id_variant' => 9, 'id_size' => 9, 'harga' => 125000, 'stok' => 30],
            ['id_variant' => 9, 'id_size' => 10, 'harga' => 185000, 'stok' => 20],
            ['id_variant' => 10, 'id_size' => 9, 'harga' => 125000, 'stok' => 25],
            ['id_variant' => 10, 'id_size' => 10, 'harga' => 185000, 'stok' => 18],
            ['id_variant' => 11, 'id_size' => 9, 'harga' => 450000, 'stok' => 15],
            ['id_variant' => 11, 'id_size' => 10, 'harga' => 650000, 'stok' => 10],
            ['id_variant' => 12, 'id_size' => 10, 'harga' => 850000, 'stok' => 8],

            // Tas specs
            ['id_variant' => 13, 'id_size' => 13, 'harga' => 1250000, 'stok' => 12],
            ['id_variant' => 14, 'id_size' => 13, 'harga' => 1250000, 'stok' => 10],
            ['id_variant' => 15, 'id_size' => 11, 'harga' => 450000, 'stok' => 20],
            ['id_variant' => 15, 'id_size' => 12, 'harga' => 550000, 'stok' => 15],
            ['id_variant' => 16, 'id_size' => 14, 'harga' => 1850000, 'stok' => 8],

            // Pakaian specs
            ['id_variant' => 17, 'id_size' => 15, 'harga' => 450000, 'stok' => 15],
            ['id_variant' => 17, 'id_size' => 16, 'harga' => 450000, 'stok' => 20],
            ['id_variant' => 17, 'id_size' => 17, 'harga' => 450000, 'stok' => 25],
            ['id_variant' => 17, 'id_size' => 18, 'harga' => 450000, 'stok' => 20],
            ['id_variant' => 17, 'id_size' => 19, 'harga' => 450000, 'stok' => 12],
            ['id_variant' => 18, 'id_size' => 15, 'harga' => 450000, 'stok' => 12],
            ['id_variant' => 18, 'id_size' => 16, 'harga' => 450000, 'stok' => 18],
            ['id_variant' => 18, 'id_size' => 17, 'harga' => 450000, 'stok' => 22],
            ['id_variant' => 18, 'id_size' => 18, 'harga' => 450000, 'stok' => 18],
            ['id_variant' => 19, 'id_size' => 16, 'harga' => 250000, 'stok' => 25],
            ['id_variant' => 19, 'id_size' => 17, 'harga' => 250000, 'stok' => 30],
            ['id_variant' => 19, 'id_size' => 18, 'harga' => 250000, 'stok' => 25],
            ['id_variant' => 20, 'id_size' => 16, 'harga' => 250000, 'stok' => 20],
            ['id_variant' => 20, 'id_size' => 17, 'harga' => 250000, 'stok' => 28],
            ['id_variant' => 20, 'id_size' => 18, 'harga' => 250000, 'stok' => 22],
            ['id_variant' => 21, 'id_size' => 16, 'harga' => 550000, 'stok' => 12],
            ['id_variant' => 21, 'id_size' => 17, 'harga' => 550000, 'stok' => 15],
            ['id_variant' => 21, 'id_size' => 18, 'harga' => 550000, 'stok' => 12],

            // Topi specs
            ['id_variant' => 22, 'id_size' => 20, 'harga' => 150000, 'stok' => 30],
            ['id_variant' => 23, 'id_size' => 20, 'harga' => 150000, 'stok' => 25],
            ['id_variant' => 24, 'id_size' => 20, 'harga' => 125000, 'stok' => 35],
            ['id_variant' => 25, 'id_size' => 20, 'harga' => 175000, 'stok' => 20],

            // Kompor specs
            ['id_variant' => 26, 'id_size' => 21, 'harga' => 350000, 'stok' => 15],
            ['id_variant' => 26, 'id_size' => 22, 'harga' => 550000, 'stok' => 10],
            ['id_variant' => 27, 'id_size' => 21, 'harga' => 1250000, 'stok' => 8],
            ['id_variant' => 28, 'id_size' => 21, 'harga' => 850000, 'stok' => 12],

            // Furniture specs
            ['id_variant' => 29, 'id_size' => 23, 'harga' => 285000, 'stok' => 20],
            ['id_variant' => 30, 'id_size' => 23, 'harga' => 285000, 'stok' => 18],
            ['id_variant' => 31, 'id_size' => 23, 'harga' => 425000, 'stok' => 15],
            ['id_variant' => 32, 'id_size' => 23, 'harga' => 375000, 'stok' => 12],
        ];

        foreach ($specs as $spec) {
            ProductVariantSpec::create($spec);
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
                'status_pembayaran' => 'paid',
            ],
            [
                'id' => 2,
                'id_user' => 3,
                'tgl_order' => '2025-12-05 14:20:00',
                'total_harga' => 1500000,
                'status_pembayaran' => 'paid',
            ],
            [
                'id' => 3,
                'id_user' => 4,
                'tgl_order' => '2025-12-08 09:15:00',
                'total_harga' => 3200000,
                'status_pembayaran' => 'pending',
            ],
            [
                'id' => 4,
                'id_user' => 5,
                'tgl_order' => '2025-12-12 16:45:00',
                'total_harga' => 875000,
                'status_pembayaran' => 'paid',
            ],
            [
                'id' => 5,
                'id_user' => 2,
                'tgl_order' => '2025-12-15 11:00:00',
                'total_harga' => 1750000,
                'status_pembayaran' => 'pending',
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        // 10. Order Items
        $orderItems = [
            // Order 1 - Budi beli tenda dan matras
            [
                'id_order' => 1,
                'id_variant' => 1,
                'tgl_order' => '2025-12-01 10:30:00',
                'quantity' => 1,
                'harga' => 1200000,
            ],
            [
                'id_order' => 1,
                'id_variant' => 9,
                'tgl_order' => '2025-12-01 10:30:00',
                'quantity' => 2,
                'harga' => 450000,
            ],

            // Order 2 - Siti beli sepatu hiking
            [
                'id_order' => 2,
                'id_variant' => 5,
                'tgl_order' => '2025-12-05 14:20:00',
                'quantity' => 1,
                'harga' => 950000,
            ],
            [
                'id_order' => 2,
                'id_variant' => 19,
                'tgl_order' => '2025-12-05 14:20:00',
                'quantity' => 2,
                'harga' => 250000,
            ],

            // Order 3 - Ahmad beli tas carrier dan jaket
            [
                'id_order' => 3,
                'id_variant' => 16,
                'tgl_order' => '2025-12-08 09:15:00',
                'quantity' => 1,
                'harga' => 1850000,
            ],
            [
                'id_order' => 3,
                'id_variant' => 17,
                'tgl_order' => '2025-12-08 09:15:00',
                'quantity' => 3,
                'harga' => 450000,
            ],

            // Order 4 - Dewi beli kompor dan furniture
            [
                'id_order' => 4,
                'id_variant' => 26,
                'tgl_order' => '2025-12-12 16:45:00',
                'quantity' => 1,
                'harga' => 350000,
            ],
            [
                'id_order' => 4,
                'id_variant' => 29,
                'tgl_order' => '2025-12-12 16:45:00',
                'quantity' => 2,
                'harga' => 285000,
            ],

            // Order 5 - Budi beli lagi sepatu trail running
            [
                'id_order' => 5,
                'id_variant' => 7,
                'tgl_order' => '2025-12-15 11:00:00',
                'quantity' => 1,
                'harga' => 1850000,
            ],
        ];

        foreach ($orderItems as $item) {
            OrderItem::create($item);
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
