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
            Schema::create('daftar_arsips', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_tertib')->constrained('tertib_arsips')->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('uraian_informasi_berkas');
                $table->string('jadwal_aktif');
                $table->string('jadwal_inaktif');
                $table->string('no_berkas');
                $table->string('no_item_berkas');
                $table->string('tanggal');
                $table->string('tingkat_perkembangan');
                $table->string('jmlh_berkas');
                $table->string('lokasi_simpan');
                $table->string('file_arsip');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_arsips');
    }
};
