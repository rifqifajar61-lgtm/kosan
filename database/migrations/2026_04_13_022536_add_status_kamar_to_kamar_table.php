<?php
// database/migrations/xxxx_add_status_kamar_to_kamar_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kamar', function (Blueprint $table) {
            $table->enum('status_kamar', ['aktif', 'nonaktif'])
                  ->default('aktif')
                  ->after('fasilitas_kamar');
        });
    }

    public function down(): void
    {
        Schema::table('kamar', function (Blueprint $table) {
            $table->dropColumn('status_kamar');
        });
    }
};