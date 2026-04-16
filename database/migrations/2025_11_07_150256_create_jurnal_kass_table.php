<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal_kas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('keterangan');
            $table->foreignId('petugas')->constrained('users')->onDelete('cascade');
            $table->foreignId('jenis_transaksi_id')->constrained('jenis_transaksi')->onDelete('cascade');
            $table->enum('metode', ['CASH', 'TRANSFER']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_kas');
    }
};
