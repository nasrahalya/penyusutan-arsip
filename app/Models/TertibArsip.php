<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TertibArsip extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_klasifikasi' ,
        'uraian_klasifikasi' ,
        'klasifikasi_keamanan',
        'hak_akses',
        'jadwal_aktif',
        'jadwal_inaktif',
        'ket'
    ];

    public function daftarArsips() {
        return $this->hasMany(DaftarArsip::class, 'id_tertib');
    }
}
