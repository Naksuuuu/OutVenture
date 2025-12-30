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

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Brands (3 brands untuk testing)
        $brands = [
            ['id' => 1, 'nama_brand' => 'Eiger', 'is_trusted' => true],
            ['id' => 2, 'nama_brand' => 'Consina', 'is_trusted' => false],
            ['id' => 3, 'nama_brand' => 'The North Face', 'is_trusted' => true],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // 2. Colors (4 colors untuk testing)
        $colors = [
            ['id' => 1, 'nama_warna' => 'Hitam', 'hex_code' => '#000000'],
            ['id' => 2, 'nama_warna' => 'Biru', 'hex_code' => '#2563EB'],
            ['id' => 3, 'nama_warna' => 'Merah', 'hex_code' => '#DC2626'],
            ['id' => 4, 'nama_warna' => 'Hijau', 'hex_code' => '#16A34A'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }

        // 3. Categories + SizeGroups + SizeValues (3 categories untuk testing)
        $categories = [
            ['id' => 1, 'nama_category' => 'Tenda', 'sizes' => ['2 Orang', '4 Orang']],
            ['id' => 2, 'nama_category' => 'Sepatu', 'sizes' => ['39', '40', '41', '42']],
            ['id' => 3, 'nama_category' => 'Matras', 'sizes' => ['Single', 'Double']],
        ];

        $sizeLookup = [];

        foreach ($categories as $category) {
            // Create size group
            $group = SizeGroup::create([
                'nama_group' => $category['nama_category'] . ' sizes',
            ]);

            // Create category (slug akan auto-generate)
            $categoryModel = Category::create([
                'id' => $category['id'],
                'nama_category' => $category['nama_category'],
                'id_size_group' => $group->id,
            ]);

            // Create size values
            $sort = 1;
            foreach ($category['sizes'] as $sizeLabel) {
                $sizeModel = SizeValue::create([
                    'id_size_group' => $group->id,
                    'label_size' => $sizeLabel,
                    'sort_order' => $sort++,
                ]);

                $sizeLookup[$categoryModel->id][$sizeLabel] = $sizeModel->id;
            }
        }

        // 4. Products + Variants + Variant Specs (3 products untuk testing)
        $products = [
            [
                'id' => 1,
                'nama_product' => 'Tenda Dome Waterproof',
                'id_category' => 1,
                'id_brand' => 1,
                'deskripsi' => 'Tenda dome anti air dengan material berkualitas tinggi, cocok untuk camping keluarga',
                'variants' => [
                    [
                        'id' => 1,
                        'id_color' => 4,
                        'sku_prefix' => 'TND-DOM-GRN',
                        'specs' => [
                            ['size_label' => '2 Orang', 'harga' => 850000, 'stok' => 15],
                            ['size_label' => '4 Orang', 'harga' => 1200000, 'stok' => 12],
                        ]
                    ],
                    [
                        'id' => 2,
                        'id_color' => 3,
                        'sku_prefix' => 'TND-DOM-RED',
                        'specs' => [
                            ['size_label' => '2 Orang', 'harga' => 850000, 'stok' => 10],
                            ['size_label' => '4 Orang', 'harga' => 1200000, 'stok' => 8],
                        ]
                    ],
                ]
            ],
            [
                'id' => 2,
                'nama_product' => 'Sepatu Hiking Mid Cut',
                'id_category' => 2,
                'id_brand' => 1,
                'deskripsi' => 'Sepatu hiking dengan ankle support dan grip kuat',
                'variants' => [
                    [
                        'id' => 3,
                        'id_color' => 1,
                        'sku_prefix' => 'SPT-HIK-BLK',
                        'specs' => [
                            ['size_label' => '39', 'harga' => 950000, 'stok' => 8],
                            ['size_label' => '40', 'harga' => 950000, 'stok' => 12],
                            ['size_label' => '41', 'harga' => 950000, 'stok' => 15],
                            ['size_label' => '42', 'harga' => 950000, 'stok' => 12],
                        ]
                    ],
                ]
            ],
            [
                'id' => 3,
                'nama_product' => 'Matras Busa Lipat',
                'id_category' => 3,
                'id_brand' => 2,
                'deskripsi' => 'Matras busa EVA tebal 5cm, mudah dilipat',
                'variants' => [
                    [
                        'id' => 4,
                        'id_color' => 2,
                        'sku_prefix' => 'MAT-BSA-BLU',
                        'specs' => [
                            ['size_label' => 'Single', 'harga' => 125000, 'stok' => 30],
                            ['size_label' => 'Double', 'harga' => 185000, 'stok' => 20],
                        ]
                    ],
                ]
            ],
        ];

        foreach ($products as $product) {
            // Create product (slug akan auto-generate)
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
                    $sizeId = $sizeLookup[$productModel->id][$spec['size_label']] ?? null;
                    if (!$sizeId) continue;

                    // Generate SKU: PREFIX-SIZE
                    $sizeForSku = str_replace(' ', '', $spec['size_label']);
                    $sku = $variant['sku_prefix'] . '-' . $sizeForSku;

                    ProductVariantSpec::create([
                        'id_variant' => $variantModel->id,
                        'id_size_value' => $sizeId,
                        'sku' => $sku,
                        'harga' => $spec['harga'],
                        'stok' => $spec['stok'],
                    ]);
                }
            }
        }

        // 5. Users (superadmin + admin + user untuk testing)
        $users = [
            [
                'id' => 1,
                'nama_lengkap' => 'Admin Outventure',
                'email' => 'admin@outventure.com',
                'email_verified_at' => now(),
                'alamat' => 'Jl. Outdoor Adventure No. 1, Jakarta',
                'password' => bcrypt('admin123'),
                'role' => 'superadmin',
            ],
            [
                'id' => 2,
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'email_verified_at' => now(),
                'alamat' => 'Jl. Gunung Merapi No. 10, Bandung',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'id' => 3,
                'nama_lengkap' => 'Admin Test',
                'email' => 'admintest@outventure.com',
                'email_verified_at' => now(),
                'alamat' => 'Jl. Test No. 1, Jakarta',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // 6. Orders (1 order untuk testing)
        $order = Order::create([
            'id' => 1,
            'id_user' => 2,
            'tgl_order' => now(),
            'total_harga' => 2100000,
            'status_pembayaran' => 1, // paid
        ]);

        // 7. Order Items
        $orderItems = [
            ['sku' => 'TND-DOM-GRN-4Orang', 'quantity' => 1, 'harga' => 1200000],
            ['sku' => 'MAT-BSA-BLU-Double', 'quantity' => 2, 'harga' => 185000],
        ];

        foreach ($orderItems as $item) {
            $spec = ProductVariantSpec::where('sku', $item['sku'])->first();
            if (!$spec) continue;

            OrderItem::create([
                'id_order' => $order->id,
                'id_variant_spec' => $spec->id,
                'tgl_order' => now(),
                'quantity' => $item['quantity'],
                'harga' => $item['harga'],
            ]);
        }

        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('📊 Summary:');
        $this->command->info('   - Brands: ' . Brand::count());
        $this->command->info('   - Colors: ' . Color::count());
        $this->command->info('   - Categories: ' . Category::count());
        $this->command->info('   - Products: ' . Product::count());
        $this->command->info('   - Product Variants: ' . ProductVariant::count());
        $this->command->info('   - Product Variant Specs: ' . ProductVariantSpec::count());
        $this->command->info('   - Users: ' . User::count());
        $this->command->info('   - Orders: ' . Order::count());
    }
}
