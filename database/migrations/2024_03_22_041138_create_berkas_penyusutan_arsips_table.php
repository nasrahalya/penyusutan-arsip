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
        Schema::create('berkas_penyusutan_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('tgl_naskah');
            $table->string('no_naskah');
            $table->string('hal');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('file_arsip_inaktif');
            $table->string('file_berita_acara');
            $table->string('status_kirim');
            $table->string('status_penandatanganan')->nullable();
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_penyusutan_arsips');
    }
};
