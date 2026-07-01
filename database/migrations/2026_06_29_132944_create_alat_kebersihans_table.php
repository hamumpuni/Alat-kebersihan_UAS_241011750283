<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kategori: Data Alat Kebersihan Kantor
     * Kolom wajib: ID Alat (id), Gambar, Nama Alat, Jenis, Kondisi, Lokasi Penyimpanan
     */
    public function up(): void
    {
        Schema::create('alat_kebersihans', function (Blueprint $table) {
            $table->id('id_alat');
            $table->string('gambar')->nullable();
            $table->string('nama_alat');
            $table->string('jenis');
            $table->string('kondisi');
            $table->string('lokasi_penyimpanan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat_kebersihans');
    }
};