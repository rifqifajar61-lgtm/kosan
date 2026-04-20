<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemasukan', function (Blueprint $table) {

    // Pakai UUID juga
    $table->uuid('id_pemasukan')->primary();

    // Foreign UUID (samakan dengan sewa)
    $table->uuid('id_sewa');

    $table->dateTime('tanggal_pemasukan');
    $table->decimal('jumlah_bayar', 12, 2);
    $table->timestamps();

    $table->foreign('id_sewa')
          ->references('id_sewa')
          ->on('sewa')
          ->cascadeOnDelete();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};