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
       Schema::create('sewa', function (Blueprint $table) {
            $table->id('id_sewa');
            $table->string('id_penghuni', 20);
            $table->string('id_kamar', 20);
            $table->enum('status', ['aktif', 'selesai']);
            $table->timestamps();

            $table->foreign('id_penghuni')
                  ->references('id_penghuni')
                  ->on('penghuni')
                  ->onDelete('cascade');

            $table->foreign('id_kamar')
                  ->references('id_kamar')
                  ->on('kamar')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa');
    }
};
