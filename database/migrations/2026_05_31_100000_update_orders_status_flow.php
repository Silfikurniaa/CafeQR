<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method', 20)->nullable()->after('status');
        });

        DB::statement("ALTER TABLE orders MODIFY status ENUM('Baru', 'Diproses', 'SiapBayar', 'Selesai', 'Batal') NOT NULL DEFAULT 'Baru'");
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });

        DB::statement("ALTER TABLE orders MODIFY status ENUM('Baru', 'Diproses', 'Selesai') NOT NULL DEFAULT 'Baru'");
    }
};
