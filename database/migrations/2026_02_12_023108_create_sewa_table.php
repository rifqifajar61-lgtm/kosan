<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sewa', function (Blueprint $table) {

            // ID SEWA pakai UUID
            $table->uuid('id_sewa')->primary();

            // Foreign key UUID
            $table->uuid('id_penghuni');
            $table->uuid('id_kamar');

            // 🔥 Tambahan tanggal kontrak
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();

            $table->enum('status', ['aktif', 'selesai'])
                  ->default('aktif');

            $table->timestamps();

            // FK penghuni
            $table->foreign('id_penghuni')
                ->references('id_penghuni')
                ->on('penghuni')
                ->cascadeOnDelete();

            // FK kamar
            $table->foreign('id_kamar')
                ->references('id_kamar')
                ->on('kamar')
                ->cascadeOnDelete();

           $table->json('pembayaran_bulan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sewa');
    }
};