<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cafe.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'kasir@cafe.com'],
            [
                'name' => 'Kasir',
                'password' => bcrypt('password'),
                'role' => 'kasir',
                'email_verified_at' => now(),
            ],
        );

        $this->call([
            CafeTableSeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}
