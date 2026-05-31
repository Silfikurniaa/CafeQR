<?php

namespace Database\Seeders;

use App\Models\CafeTable;
use Illuminate\Database\Seeder;

class CafeTableSeeder extends Seeder
{
    public function run(): void
    {
        if (CafeTable::exists()) {
            return;
        }

        $codes = config('cafe.tables', []);
        foreach ($codes as $index => $code) {
            CafeTable::create([
                'code' => strtoupper($code),
                'is_active' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
