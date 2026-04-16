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
        Schema::create('jenis_transaksi', function (Blueprint $table) {
            $table->id('id'); // ID transaksi
            $table->string('nama_transaksi'); // Nama transaksi
            $table->enum('tipe_transaksi', ['MASUK', 'KELUAR']); // Tipe transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_transaksi');
    }
};
