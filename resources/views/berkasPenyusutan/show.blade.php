@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Berkas Penyusutan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penyusutan.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Naskah:</strong>
                {{ $berkasPenyusutanArsip->tgl_naskah }}
            </div>
            <div class="form-group">
                <strong>Nomor Naskah:</strong>
                {{ $berkasPenyusutanArsip->no_naskah }}
            </div>
            <div class="form-group">
                <strong>Hal:</strong>
                {{ $berkasPenyusutanArsip->hal }}
            </div>
            <div class="form-group">
                <strong>Unit Pengirim:</strong>
                {{ $berkasPenyusutanArsip->pengirim }}
            </div>
            <div class="form-group">
                <strong>Unit Penerima:</strong>
                {{ $berkasPenyusutanArsip->penerima }}
            </div>
            <div class="form-group">
                <strong>File Arsip Inaktif:</strong>
                <img src="/file_arsip_inaktif/{{ $berkasPenyusutanArsip->file_arsip_inaktif }}" width="250px" alt="">
            </div>
            <div class="form-group">
                <strong>File Berita Acara:</strong>
                <img src="/file_berita_acara/{{ $berkasPenyusutanArsip->file_berita_acara }}" width="250px" alt="">
            </div>
            <div class="form-group">
                <strong>Status Kirim:</strong>
                {{ $berkasPenyusutanArsip->status_kirim }}
            </div>
            <div class="form-group">
                <strong>Status Penandatanganan:</strong>
                {{ $berkasPenyusutanArsip->status_penandatanganan }}
            </div>
            <div class="form-group">
                <strong>Lampiran:</strong>
                {{ $berkasPenyusutanArsip->lampiran }}
            </div>
        </div>
    </div>
@endsection