<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarArsipInaktif extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tertib() {
        return $this->belongsTo(DaftarArsip::class, 'id_arsip');
    }
}
