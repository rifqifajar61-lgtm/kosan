<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penghuni', function (Blueprint $table) {
            // UUID sebagai primary key
            $table->uuid('id_penghuni')->primary();

            $table->string('nama_penghuni', 100);
            $table->text('alamat_penghuni');
            $table->string('no_ktp', 20);
            $table->string('no_hp', 15);
            $table->dateTime('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghuni');
    }
};
