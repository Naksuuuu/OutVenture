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
        User::create([

            'id' => 1,
            'nama_lengkap' => 'Super Admin',
            'email' => 'outventureindonesia@gmail.com',
            'email_verified_at' => now(),
            'alamat' => 'Jl. Outdoor Adventure No. 1, Bandung',
            'password' => bcrypt('superadmin123'),
            'role' => 'superadmin',

        ]);
    }
}
