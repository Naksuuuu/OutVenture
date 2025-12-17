<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            AttributeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            ProductVariantSpecSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,

        ]);

        User::create([
            'nama_lengkap' => 'nama User',
            'email' => 'test@example.com',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No.123, Kota Contoh',
            'password' => bcrypt('password'), // password
            'role' => 'admin',
        ]);
    }
}
