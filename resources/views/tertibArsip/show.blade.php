@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Tertib Arsip</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tertibArsip.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Klasifikasi:</strong>
                {{ $tertibArsip->kd_klasifikasi }}
            </div>
            <div class="form-group">
                <strong>Uraian Klasifikas:</strong>
                {{ $tertibArsip->uraian_klasifikasi }}
            </div>
            <div class="form-group">
                <strong>Uraian Klasifikas:</strong>
                {{ $tertibArsip->uraian_klasifikasi }}
            </div>
            <div class="form-group">
                <strong>Klasifikasi Keamanan:</strong>
                {{ $tertibArsip->klasifikasi_keamanan }}
            </div>
            <div class="form-group">
                <strong>Hak Akses:</strong>
                {{ $tertibArsip->hak_akses }}
            </div>
            <div class="form-group">
                <strong>Jadwal Aktif:</strong>
                {{ $tertibArsip->jadwal_aktif }}
            </div>
            <div class="form-group">
                <strong>Jadwal Inaktif:</strong>
                {{ $tertibArsip->jadwal_inaktif }}
            </div>
            <div class="form-group">
                <strong>Keterangan:</strong>
                {{ $tertibArsip->ket }}
            </div>
        </div>
    </div>
@endsection