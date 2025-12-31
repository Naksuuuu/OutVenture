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
}
