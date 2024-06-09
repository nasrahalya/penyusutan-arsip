<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPenyusutanArsip extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_naskah' ,
        'no_naskah' ,
        'hal',
        'pengirim',
        'penerima',
        'file_arsip_inaktif',
        'file_berita_acara',
        'status_kirim',
        'status_penandatanganan',
        'lampiran'
    ];
}
