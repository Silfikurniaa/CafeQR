<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        if (MenuItem::exists()) {
            return;
        }

        $stocks = [12, 3, 8, 6, 0, 15, 4, 10];
        $items = config('cafe.menu', []);

        foreach ($items as $index => $item) {
            MenuItem::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'category' => $item['category'],
                'emoji' => $item['emoji'],
                'stock' => $stocks[$index] ?? 10,
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
