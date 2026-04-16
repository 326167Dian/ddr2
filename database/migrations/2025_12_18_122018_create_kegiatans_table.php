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
        if (!Schema::hasTable('kegiatans')) {
            Schema::create('kegiatans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('program_kerja_id')->constrained('program_kerjas')->cascadeOnDelete();
                $table->foreignId('bidang_id')->constrained('bidangs')->cascadeOnDelete();
                $table->string('nama_kegiatan');
                $table->string('slug');
                $table->text('deskripsi')->nullable();
                $table->string('lokasi')->nullable();
                $table->date('tanggal_mulai');
                $table->date('tanggal_selesai')->nullable();
                $table->bigInteger('anggaran')->nullable();
                $table->string('status')->default('draft');
                $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
