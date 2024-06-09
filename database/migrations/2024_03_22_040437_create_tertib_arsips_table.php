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
        Schema::create('tertib_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('kd_klasifikasi');
            $table->string('uraian_klasifikasi');
            $table->string('klasifikasi_keamanan');
            $table->string('hak_akses');
            $table->string('jadwal_aktif');
            $table->string('jadwal_inaktif');
            $table->string('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tertib_arsips');
    }
};
