<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('table_id');        // nomor meja, contoh: "A3"
            $table->json('items');             // array item pesanan
            $table->enum('status', ['Baru', 'Diproses', 'Selesai'])->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};