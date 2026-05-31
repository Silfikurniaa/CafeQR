<?php

return [

    'low_stock_threshold' => 5,

    /*
    |--------------------------------------------------------------------------
    | Nomor meja (fallback jika belum di-seed ke database)
    |--------------------------------------------------------------------------
    */
    'tables' => ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7'],

    /*
    |--------------------------------------------------------------------------
    | Menu (sementara hardcoded — nanti bisa dari database)
    |--------------------------------------------------------------------------
    */
    'menu' => [
        ['id' => 1, 'name' => 'Nasi Goreng Spesial', 'price' => 18000, 'category' => 'Makanan', 'emoji' => '🍳'],
        ['id' => 2, 'name' => 'Mie Ayam Bakso',      'price' => 16000, 'category' => 'Makanan', 'emoji' => '🍜'],
        ['id' => 3, 'name' => 'Ayam Bakar',           'price' => 22000, 'category' => 'Makanan', 'emoji' => '🍗'],
        ['id' => 4, 'name' => 'Soto Ayam',            'price' => 15000, 'category' => 'Makanan', 'emoji' => '🥣'],
        ['id' => 5, 'name' => 'Es Teh Manis',         'price' => 5000,  'category' => 'Minuman', 'emoji' => '🧋'],
        ['id' => 6, 'name' => 'Kopi Hitam',           'price' => 8000,  'category' => 'Minuman', 'emoji' => '☕'],
        ['id' => 7, 'name' => 'Jus Alpukat',          'price' => 12000, 'category' => 'Minuman', 'emoji' => '🥑'],
        ['id' => 8, 'name' => 'Es Jeruk',             'price' => 7000,  'category' => 'Minuman', 'emoji' => '🍊'],
    ],

];
