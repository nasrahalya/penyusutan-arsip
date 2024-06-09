@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Berkas Penyusutan</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penyusutan.index') }}"> Back</a>
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

    <form action="{{ route('penyusutan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Naskah:</strong>
                    <input type="date" name="tgl_naskah" class="form-control" placeholder="Tanggal Naskah">
                </div>
                <div class="form-group">
                    <strong>Nomor Naskah:</strong>
                    <input type="text" name="no_naskah" class="form-control" placeholder="Nomor Naskah">
                </div>
                <div class="form-group">
                    <strong>Hal:</strong>
                    <input type="text" name="hal" class="form-control" placeholder="Hal">
                </div>
                <div class="form-group">
                    <strong>Unit Pengirim:</strong>
                    <input type="text" name="pengirim" class="form-control" placeholder="Unit Pengirim">
                </div>
                <div class="form-group">
                    <strong>Unit Penerima:</strong>
                    <input type="text" name="penerima" class="form-control" placeholder="Unit Penerima">
                </div>
                <div class="form-group">
                    <strong>File Arsip Inaktif:</strong>
                    <input type="file" name="file_arsip_inaktif" class="form-control" placeholder="File Arsip Inaktif">
                </div>
                <div class="form-group">
                    <strong>File Berkas Penyusutan:</strong>
                    <input type="file" name="file_berita_acara" class="form-control"
                        placeholder="File Berkas Penyusutan">
                </div>
                {{-- <div class="form-group">
                    <strong>Status Kirim:</strong>
                    <input type="text" name="status_kirim" class="form-control" placeholder="Status Kirim">
                </div> --}}
                {{-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status_kirim" id="terkirimCheckbox" value="terkirim">
                    <label class="form-check-label" for="terkirimCheckbox">Terkirim</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status_kirim" id="tidakTerkirimCheckbox" value="tidak_terkirim">
                    <label class="form-check-label" for="tidakTerkirimCheckbox">Tidak Terkirim</label>
                </div>
                
                <div class="form-group">
                    <strong>Status Penandatanganan:</strong>
                    <input type="text" name="status_penandatanganan" class="form-control"
                        placeholder="Status Penandatanganan"> --}}
                </div>
                <div class="form-group">
                    <strong>Lampiran:</strong>
                    <input type="file" name="lampiran" class="form-control" placeholder="Lampiran">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
