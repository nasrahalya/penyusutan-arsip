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
        Schema::create('daftar_arsip_inaktifs', function (Blueprint $table) {
            $table->id();
            $table->string('kd_klasifikasi');
            $table->string('uraian_klasifikasi');
            $table->string('uraian_informasi_berkas');
            $table->string('kurun_waktu');
            $table->string('tingkat_perkembangan');
            $table->string('jumlah_berkas');
            $table->string('no_box');
            $table->string('lokasi_simpan');
            $table->string('jangka_simpan_inaktif');
            $table->string('klasifikasi_keamanan');
            $table->string('hak_akses');
            $table->string('ket');
            $table->string('file_arsip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_arsip_inaktifs');
    }
};
