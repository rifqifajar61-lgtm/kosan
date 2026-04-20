<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemasukan', function (Blueprint $table) {
            // Menyimpan array bulan yang dicakup pembayaran ini
            // Contoh: ["2025-01", "2025-02"] = Januari–Februari 2025
            $table->json('bulan_dibayar')->nullable()->after('jumlah_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('pemasukan', function (Blueprint $table) {
            $table->dropColumn('bulan_dibayar');
        });
    }
};