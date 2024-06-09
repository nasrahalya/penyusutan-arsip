@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Daftar Arsip</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('daftarArsip.index') }}"> Back</a>
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

    <form action="{{ route('daftarArsip.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Kode Klasifikasi</label>
                    <select class="custom-select" name="id_tertib" id="inputGroupSelect01">
                        @foreach($tertib as $tr)
                            <option value="{{ $tr->id }}">{{ $tr->kd_klasifikasi }}</option>
                        @endforeach
                    </select>                    
                </div>    
                <div class="form-group">
                    <strong>Uraian Informasi Berkas:</strong>
                    <input type="text" name="uraian_informasi_berkas" class="form-control" placeholder="Uraian Informasi Berkas">
                </div>
                <div class="form-group">
                    <strong>No Berkas:</strong>
                    <input type="text" name="no_berkas" class="form-control" placeholder="No Berkas">
                </div>
                <div class="form-group">
                    <strong>No Item Berkas:</strong>
                    <input type="text" name="no_item_berkas" class="form-control" placeholder="No Item Berkas">
                </div>
                <div class="form-group">
                    <strong>Tanggal:</strong>
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal">
                </div>
                <div class="form-group">
                    <strong>Tingkat Perkembangan:</strong>
                    <input type="text" name="tingkat_perkembangan" class="form-control" placeholder="Tingkat Perkembangan">
                </div>
                <div class="form-group">
                    <strong>Jumlah Berkas:</strong>
                    <input type="text" name="jmlh_berkas" class="form-control" placeholder="Jumlah Berkas">
                </div>
                <div class="form-group">
                    <strong>Lokasi Simpan:</strong>
                    <input type="text" name="lokasi_simpan" class="form-control" placeholder="Uraian Klasifikasi">
                </div>
                <div class="form-group">
                    <strong>File Arsip:</strong>
                    <input type="file" name="file_arsip" class="form-control" placeholder="File Arsip">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
