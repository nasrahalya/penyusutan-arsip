@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Tertib Arsip</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tertibArsip.index') }}"> Back</a>
            </div>
            <br>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your
            input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tertibArsip.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kode Klasifikasi:</strong>
                    <input type="text" name="kd_klasifikasi" class="form-control" placeholder="Kode Klasifikasi">
                </div>
                <div class="form-group">
                    <strong>Uraian Klasifikasi:</strong>
                    <input type="text" name="uraian_klasifikasi" class="form-control" placeholder="Uraian Klasifikasi">
                </div>
                <div class="form-group">
                    <strong>Klasifikasi Keamanan:</strong>
                    <input type="text" name="klasifikasi_keamanan" class="form-control" placeholder="Klasifikasi Keamanan">
                </div>
                <div class="form-group">
                    <strong>Hak Akses:</strong>
                    <input type="text" name="hak_akses" class="form-control" placeholder="Hak Akses">
                </div>
                <div class="form-group">
                    <strong>Jadwal Aktif:</strong>
                    <input type="text" name="jadwal_aktif" class="form-control" placeholder="Jadwal Aktif">
                </div>
                <div class="form-group">
                    <strong>Jadwal Inaktif:</strong>
                    <input type="text" name="jadwal_inaktif" class="form-control" placeholder="Jadwal Inaktif">
                </div>
                <div class="form-group">
                    <strong>Keterangan:</strong>
                    <input type="text" name="ket" class="form-control" placeholder="Keterangan">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
