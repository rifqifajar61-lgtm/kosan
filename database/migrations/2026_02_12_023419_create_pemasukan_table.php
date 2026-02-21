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
       Schema::create('pemasukan', function (Blueprint $table) {
            $table->string('id_pemasukan', 20)->primary();
            $table->unsignedBigInteger('id_sewa');
            $table->dateTime('tanggal_pemasukan');
            $table->decimal('jumlah_bayar', 12, 2);
            $table->timestamps();

            $table->foreign('id_sewa')
                  ->references('id_sewa')
                  ->on('sewa')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};
