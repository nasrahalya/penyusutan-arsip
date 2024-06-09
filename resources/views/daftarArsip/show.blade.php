@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Daftar Arsip</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('daftarArsip.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Klasifikasi:</strong>
                {{ $daftarArsip->tertib->kd_klasifikasi }}
            </div>
            <div class="form-group">
                <strong>Uraian Klasifikas:</strong>
                {{ $daftarArsip->tertib->uraian_klasifikasi }}
            </div>
            <div class="form-group">
                <strong>Uraian Informasi Berkas:</strong>
                {{ $daftarArsip->uraian_informasi_berkas }}
            </div>
            <div class="form-group">
                <strong>No Berkas:</strong>
                {{ $daftarArsip->no_berkas }}
            </div>
            <div class="form-group">
                <strong>No Item Berkas:</strong>
                {{ $daftarArsip->no_item_berkas }}
            </div>
            <div class="form-group">
                <strong>Tanggal:</strong>
                {{ $daftarArsip->tanggal }}
            </div>
            <div class="form-group">
                <strong>Tingkat Perkembangan:</strong>
                {{ $daftarArsip->tingkat_perkembangan }}
            </div>
            <div class="form-group">
                <strong>Jumlah Berkas:</strong>
                {{ $daftarArsip->jmlh_berkas }}
            </div>
            <div class="form-group">
                <strong>Lokasi Simpan:</strong>
                {{ $daftarArsip->lokasi_simpan }}
            </div>
            <div class="form-group">
                <strong>Aktif Hingga:</strong>
                {{ $daftarArsip->tertib->jadwal_aktif }}
            </div>
            <div class="form-group">
                <strong>Inaktif Hingga:</strong>
                {{ $daftarArsip->tertib->jadwal_inaktif }}
            </div>
            <div class="form-group">
                <strong>Klasifikasi Keamanan:</strong>
                {{ $daftarArsip->tertib->klasifikasi_keamanan }}
            </div>
            <div class="form-group">
                <strong>Hak Akses:</strong>
                {{ $daftarArsip->tertib->hak_akses }}
            </div>
            <div class="form-group">
                <strong>Keterangan:</strong>
                {{ $daftarArsip->tertib->ket }}
            </div>
            <div class="form-group">
                <strong>File Arsip:</strong>
                <img src="/file_arsip/{{ $daftarArsip->file_arsip }}" width="250px" alt="">
            </div>
        </div>
    </div>
@endsection